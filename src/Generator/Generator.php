<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilLog;
use ilSrPluginGeneratorPlugin;
use ilUtil;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Generator
 *
 * @package srag\Plugins\SrPluginGenerator\Generator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class Generator
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const SRAG_PREFIX = "srag\\";
    /**
     * @var array
     */
    protected static $parse_placeholders_exts
        = [
            "css",
            "html",
            "js",
            "json",
            "lang",
            "less",
            "md",
            "php",
            "sql",
            "svg",
            "xml",
            "yml"
        ];
    /**
     * @var Options
     */
    protected $options;
    /**
     * @var string|null
     */
    protected $temp_name = null;
    /**
     * @var string|null
     */
    protected $temp_base_dir = null;
    /**
     * @var string|null
     */
    protected $temp_dir = null;
    /**
     * @var string|null
     */
    protected $temp_file = null;
    /**
     * @var string|null
     */
    protected $deliver_name = null;
    /**
     * @var array
     */
    protected $placeholders = [];


    /**
     * Generator constructor
     *
     * @param Options $options
     */
    public function __construct(Options $options)
    {
        $this->options = $options;
    }


    /**
     *
     */
    public function generate()/*: void*/
    {
        $this->copyToTemp();

        $this->parsePlaceholders();

        $this->runComposerUpdate();

        $this->zip();

        $this->log();

        $this->deliver();
    }


    /**
     *
     */
    protected function copyToTemp()/*: void*/
    {
        $base_template_dir = Slots::SLOTS_TEMPLATE_DIR . "/base";
        $template_dir = Slots::SLOTS_TEMPLATE_DIR . "/" . $this->options->getPluginSlot();

        $this->temp_name = ilUtil::randomhash();

        $this->temp_base_dir = self::srPluginGenerator()->generator()->getTempFolder() . "/" . $this->temp_name;

        $this->temp_dir = $this->temp_base_dir . "/" . $this->options->getPluginSlot() . "/" . $this->options->getPluginName();

        $this->temp_file = $this->temp_base_dir . ".zip";

        ilUtil::makeDirParents(dirname($this->temp_dir));

        exec("cp -r " . escapeshellarg($base_template_dir) . " " . escapeshellarg($this->temp_dir));

        if (substr($this->options->getNamespace(), 0, strlen(self::SRAG_PREFIX)) === self::SRAG_PREFIX) {
            exec("cp -r " . escapeshellarg($base_template_dir) . ".srag/* " . escapeshellarg($this->temp_dir));
        }

        exec("cp -r " . escapeshellarg($template_dir) . "/* " . escapeshellarg($this->temp_dir));

        $this->deliver_name = $this->options->getPluginId() . ".zip";
    }


    /**
     *
     */
    protected function parsePlaceholders()/*: void*/
    {
        $authors = [
            ["__RESPONSIBLE_NAME__", "__RESPONSIBLE_EMAIL__"]
        ];
        if ($this->options->getResponsibleName() !== Options::DEFAULT_RESPONSIBLE_NAME || $this->options->getResponsibleEmail() !== Options::DEFAULT_RESPONSIBLE_EMAIL) {
            $authors[] = [Options::DEFAULT_RESPONSIBLE_NAME, Options::DEFAULT_RESPONSIBLE_EMAIL];
        }
        $author_comment = implode("\n * ", array_map(function (array $author) : string {
            return "@author " . $author[0] . " <" . $author[1] . ">";
        }, $authors));

        $namespace = $this->options->getNamespace();
        if ((strrpos($namespace, "\\") === (strlen($namespace) - 1))) {
            $namespace = substr($namespace, 0, strlen($namespace) - 1);
        }

        $composer_autoload_files = [];
        if ($this->options->isEnablePhpMinVersionChecker()) {
            $composer_autoload_files[] = "vendor/srag/dic/src/PHPVersionChecker.php";
        }

        $composer_scripts = [
            "srag\\LibrariesNamespaceChanger\\LibrariesNamespaceChanger::rewriteLibrariesNamespaces"
        ];
        if ($this->options->isEnablePhp72backportScript()) {
            $composer_scripts[] = "srag\\LibrariesNamespaceChanger\\PHP72Backport::PHP72Backport";
        }
        if ($this->options->isEnableAutogeneratePluginPhpAndXmlScript()) {
            $composer_scripts[] = "srag\\LibrariesNamespaceChanger\\GeneratePluginPhpAndXml::generatePluginPhpAndXml";
        }
        if ($this->options->isEnableUpdatePluginReadmeScript()) {
            $composer_scripts[] = "srag\LibrariesNamespaceChanger\UpdatePluginReadme::updatePluginReadme";
        }

        $this->placeholders = [
            "AUTHOR_COMMENT"                  => $author_comment,
            "COMPOSER_AUTOLOAD_FILES"         => implode(",
      ", array_map(function (string $file) : string {
                return json_encode($file, JSON_UNESCAPED_SLASHES);
            }, $composer_autoload_files)),
            "COMPOSER_SCRIPTS"                => implode(",
      ", array_map("json_encode", $composer_scripts)),
            "INIT_PLUGIN_VERSION"             => $this->options->getInitPluginVersion(),
            "MAX_ILIAS_VERSION"               => $this->options->getMaxIliasVersion(),
            "MIN_ILIAS_VERSION"               => $this->options->getMinIliasVersion(),
            "MIN_PHP_VERSION"                 => $this->options->getMinPhpVersion(),
            "NAMESPACE"                       => $namespace,
            "NAMESPACE_ESCAPED"               => str_replace("\\", "\\\\", $namespace),
            "NAMESPACE_SLASHES"               => str_replace("\\", "/", $namespace),
            "PLUGIN_NAME"                     => $this->options->getPluginName(),
            "PLUGIN_NAME_CAMEL_CASE"          => lcfirst($this->options->getPluginName()),
            "PLUGIN_ID"                       => $this->options->getPluginId(),
            "PLUGIN_SLOT"                     => $this->options->getPluginSlot(),
            "PROJECT_KEY"                     => $this->options->getProjectKey(),
            "RESPONSIBLE_NAME"                => $this->options->getResponsibleName(),
            "RESPONSIBLE_EMAIL"               => $this->options->getResponsibleEmail(),
            "SHOULD_USE_ONE_UPDATE_STEP_ONLY" => json_encode($this->options->isEnableShouldUseOneUpdateStepOnly()),
            "VERSION_COMMENT"                 => "\n *\n * Generated by " . ilSrPluginGeneratorPlugin::PLUGIN_NAME . " v__VERSION__",
            "VERSION"                         => self::plugin()->getPluginObject()->getVersion(),
        ];

        $this->handleFiles($this->temp_dir);
    }


    /**
     * @param string $dir
     */
    protected function handleFiles(string $dir)/*: void*/
    {
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                $file = $dir . "/" . $file;
                if (is_dir($file)) {
                    $this->handleFiles($file);
                } else {
                    $this->handlePlaceholders($file);
                }
            }
        }
    }


    /**
     * @param string $file
     */
    protected function handlePlaceholders(string $file)/*: void*/
    {
        // Replace placeholders in code
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, self::$parse_placeholders_exts)) {
            $code = file_get_contents($file);
            foreach ($this->placeholders as $key => $value) {
                $code = str_replace("__" . $key . "__", $value, $code);
            }
            file_put_contents($file, $code);
        }

        // Replace placeholders in filename
        $old_file = $file;
        foreach ($this->placeholders as $key => $value) {
            $file = str_replace("__" . $key . "__", $value, $file);
        }
        if ($old_file !== $file) {
            rename($old_file, $file);
        }
    }


    /**
     *
     */
    protected function runComposerUpdate()/*: void*/
    {
        $composer_home = self::srPluginGenerator()->generator()->getDataFolder() . "/composer";

        ilUtil::makeDirParents($composer_home);

        exec("export COMPOSER_HOME=" . escapeshellarg($composer_home) . "&&composer update -d " . escapeshellarg($this->temp_dir));
    }


    /**
     *
     */
    protected function zip()/*: void*/
    {
        ilUtil::zip($this->temp_base_dir, $this->temp_file, true);

        ilUtil::delDir($this->temp_base_dir);
    }


    /**
     *
     */
    protected function log()/*: void*/
    {
        $client_ip = $_SERVER["HTTP_X_FORWARDED_FOR"] ?? $_SERVER["REMOTE_ADDR"];

        $log = new ilLog(self::srPluginGenerator()->generator()->getDataFolder(), "generator.log", ilSrPluginGeneratorPlugin::PLUGIN_ID);

        $log->write($client_ip . " " . json_encode($this->options, JSON_UNESCAPED_SLASHES));
    }


    /**
     *
     */
    protected function deliver()/*: void*/
    {
        ilUtil::deliverFile($this->temp_file, $this->deliver_name, "", false, true, true);
    }
}
