<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilLog;
use ilSrPluginGeneratorPlugin;
use ilUtil;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\GeneratePluginInfosHelper\SrPluginGenerator\GeneratePluginPhpAndXml;
use srag\GeneratePluginInfosHelper\SrPluginGenerator\GeneratePluginReadme;
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

    const GENERATE_PLUGIN_README_TEMPLATE = "SRAG_ILIAS_PLUGIN";
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
     * @var string|null
     */
    protected $deliver_name = null;
    /**
     * @var array
     */
    protected $extra = [];
    /**
     * @var Options
     */
    protected $options;
    /**
     * @var array
     */
    protected $placeholders = [];
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
    protected $temp_name = null;


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
    public function generate() : void
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
    protected function copyToTemp() : void
    {
        $base_template_dir = Slots::SLOTS_TEMPLATE_DIR . "/base";
        $template_dir = Slots::SLOTS_TEMPLATE_DIR . "/" . $this->options->getPluginSlot();

        $this->temp_name = ilUtil::randomhash();

        $this->temp_base_dir = self::srPluginGenerator()->generator()->getTempFolder() . "/" . $this->temp_name;

        $this->temp_dir = $this->temp_base_dir . "/" . $this->options->getPluginSlot() . "/" . $this->options->getPluginName();

        $this->temp_file = $this->temp_base_dir . ".zip";

        ilUtil::makeDirParents(dirname($this->temp_dir));

        exec("cp -r " . escapeshellarg($base_template_dir) . " " . escapeshellarg($this->temp_dir));

        if ($this->isSragPlugin()) {
            exec("cp -r " . escapeshellarg($base_template_dir) . ".srag/* " . escapeshellarg($this->temp_dir));
        }

        exec("cp -r " . escapeshellarg($template_dir) . "/* " . escapeshellarg($this->temp_dir));

        $this->deliver_name = $this->options->getPluginId() . ".zip";
    }


    /**
     *
     */
    protected function deliver() : void
    {
        ilUtil::deliverFile($this->temp_file, $this->deliver_name, "", false, true, true);
    }


    /**
     * @param string $dir
     */
    protected function handleFiles(string $dir) : void
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
    protected function handlePlaceholders(string $file) : void
    {
        // Replace placeholders in code
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, self::$parse_placeholders_exts)) {
            $code = file_get_contents($file);
            $code = $this->handlePlaceholdersCode($code);
            file_put_contents($file, $code);
        }

        // Replace placeholders in filename
        $old_file = $file;
        $file = $this->handlePlaceholdersCode($file);
        if ($old_file !== $file) {
            rename($old_file, $file);
        }
    }


    /**
     * @param string $code
     *
     * @return string
     */
    protected function handlePlaceholdersCode(string $code) : string
    {
        foreach ($this->placeholders as $key => $value) {
            $code = str_replace("__" . $key . "__", $value, $code);
        }

        return $code;
    }


    /**
     * @return bool
     */
    protected function isSragPlugin() : bool
    {
        return (substr($this->options->getNamespace(), 0, strlen(self::SRAG_PREFIX)) === self::SRAG_PREFIX);
    }


    /**
     *
     */
    protected function log() : void
    {
        $client_ip = $_SERVER["HTTP_X_FORWARDED_FOR"] ?? $_SERVER["REMOTE_ADDR"];

        $log = new ilLog(self::srPluginGenerator()->generator()->getDataFolder(), "generator.log", ilSrPluginGeneratorPlugin::PLUGIN_ID);

        $log->write($client_ip . " " . json_encode($this->options, JSON_UNESCAPED_SLASHES));
    }


    /**
     *
     */
    protected function parsePlaceholders() : void
    {
        $plugin_composer_json = json_decode(file_get_contents($this->temp_dir . "/composer.json"), true);

        $requires = [
            "php"                            => ">=__MIN_PHP_VERSION__",
            "srag/activerecordconfig"        => ">=0.1.0",
            "srag/custominputguis"           => ">=0.1.0",
            "srag/dic"                       => ">=0.1.0",
            "srag/librariesnamespacechanger" => ">=0.1.0",
            "srag/removeplugindataconfirm"   => ">=0.1.0"
        ];

        $this->extra = [
            "ilias_plugin" => [
                "id"                => $this->options->getPluginId(),
                "name"              => $this->options->getPluginName(),
                "ilias_min_version" => $this->options->getMinIliasVersion(),
                "ilias_max_version" => $this->options->getMaxIliasVersion()
            ]
        ];
        if ($this->options->getPluginSlot() === Slots::REPOSITORY_OBJECT) {
            $this->extra["ilias_plugin"]["lucene_search"] = true;
        }
        $this->extra["ilias_plugin"]["slot"] = $this->options->getPluginSlot();

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
        if ($this->options->isEnableMinPhpVersionChecker()) {
            $composer_autoload_files[] = "vendor/srag/dic/src/PHPVersionChecker.php";
        }

        $composer_scripts = [];
        if ($this->options->isEnableLibrariesnamespacechangerScript()) {
            $composer_scripts[] = "srag\\LibrariesNamespaceChanger\\LibrariesNamespaceChanger::rewriteLibrariesNamespaces";
        }
        if ($this->options->isEnablePhp72backportScript()) {
            $composer_scripts[] = "srag\\LibrariesNamespaceChanger\\PHP72Backport::PHP72Backport";
        }

        if ($this->options->isEnableAutogeneratePluginPhpAndXmlScript() || ($this->isSragPlugin() && $this->options->isEnableAutogeneratePluginReadmeScript())) {
            $requires["srag/generateplugininfoshelper"] = ">=0.1.0";

            if ($this->options->isEnableAutogeneratePluginPhpAndXmlScript()) {
                $composer_scripts[] = "srag\\GeneratePluginInfosHelper\\__PLUGIN_NAME__\\GeneratePluginPhpAndXml::generatePluginPhpAndXml";
            }

            if ($this->isSragPlugin() && $this->options->isEnableAutogeneratePluginReadmeScript()) {
                $composer_scripts[] = "srag\\GeneratePluginInfosHelper\\__PLUGIN_NAME__\\GeneratePluginReadme::generatePluginReadme";
                $extra["generate_plugin_readme_template"] = self::GENERATE_PLUGIN_README_TEMPLATE;
            }

            $plugin_composer_json["version"] = $this->options->getInitPluginVersion();
            $plugin_composer_json["extra"] = $this->extra;
        } else {
            unset($plugin_composer_json["version"]);
            unset($plugin_composer_json["extra"]);
        }

        $config_ctrl_class = [];

        $config_ctrl_execute = [
            "strtolower(ConfigCtrl::class):
                self::dic()->ctrl()->forwardCommand(new ConfigCtrl())"
        ];

        $config_tabs = [
            "ConfigCtrl::addTabs()"
        ];

        $update_languages = [
            "\$this->installRemovePluginDataConfirmLanguages()"
        ];

        if ($this->options->isEnableDevTools()) {
            $requires["srag/devtools"] = ">=0.1.0";
            $config_ctrl_class[] = "@ilCtrl_isCalledBy srag\DevTools\__PLUGIN_NAME__\DevToolsCtrl: il__PLUGIN_NAME__ConfigGUI";
            $config_ctrl_execute[] = "strtolower(DevToolsCtrl::class):
                self::dic()->ctrl()->forwardCommand(new DevToolsCtrl(\$this, self::plugin()))";
            $config_tabs[] = "DevToolsCtrl::addTabs(self::plugin())";
            $update_languages[] = "DevToolsCtrl::installLanguages(self::plugin())";
        }

        ksort($requires);

        $plugin_composer_json["require"] = $requires;
        $plugin_composer_json["autoload"]["files"] = $composer_autoload_files;
        $plugin_composer_json["scripts"]["pre-autoload-dump"] = $composer_scripts;
        file_put_contents($this->temp_dir . "/composer.json", preg_replace_callback("/\n( +)/", function (array $matches) : string {
                return "
" . str_repeat(" ", (strlen($matches[1]) / 2));
            }, json_encode($plugin_composer_json, JSON_UNESCAPED_SLASHES + JSON_PRETTY_PRINT)) . "
");

        $this->placeholders = [
            "AUTHOR_COMMENT"                  => $author_comment,
            "COMPOSER_NAME"                   => "",
            "CONFIG_CTRL_CALLS"               => (!empty($config_ctrl_class) ? "
 *
 * " . implode("
 * ", $config_ctrl_class) : ""),
            "CONFIG_CTRL_EXECUTE"             => implode(";
                break;

            case ", $config_ctrl_execute),
            "CONFIG_TABS"                     => implode(";

        ", $config_tabs),
            "INIT_PLUGIN_VERSION"             => $this->options->getInitPluginVersion(),
            "LICENSE"                         => "GPL-3.0-only",
            "MAX_ILIAS_VERSION"               => $this->options->getMaxIliasVersion(),
            "MIN_ILIAS_VERSION"               => $this->options->getMinIliasVersion(),
            "MIN_PHP_VERSION"                 => $this->options->getMinPhpVersion(),
            "NAMESPACE"                       => $namespace,
            "NAMESPACE_ESCAPED"               => str_replace("\\", "\\\\", $namespace),
            "PLUGIN_NAME"                     => $this->options->getPluginName(),
            "PLUGIN_NAME_CAMEL_CASE"          => lcfirst($this->options->getPluginName()),
            "PLUGIN_ID"                       => $this->options->getPluginId(),
            "PLUGIN_SLOT"                     => $this->options->getPluginSlot(),
            "PROJECT_KEY"                     => $this->options->getProjectKey(),
            "RESPONSIBLE_NAME"                => $this->options->getResponsibleName(),
            "RESPONSIBLE_EMAIL"               => $this->options->getResponsibleEmail(),
            "SHOULD_USE_ONE_UPDATE_STEP_ONLY" => json_encode($this->options->isEnableShouldUseOneUpdateStepOnly()),
            "UPDATE_LANGUAGES"                => implode(";

        ", $update_languages),
            "VERSION_COMMENT"                 => "\n *\n * Generated by " . ilSrPluginGeneratorPlugin::PLUGIN_NAME . " v__VERSION__",
            "VERSION"                         => self::plugin()->getPluginObject()->getVersion()
        ];

        $composer_name = explode("\\", strtolower($this->handlePlaceholdersCode($namespace)));
        $composer_name = $composer_name[0] . "/" . $composer_name[count($composer_name) - 1];
        $this->placeholders["COMPOSER_NAME"] = $composer_name;

        $this->handleFiles($this->temp_dir);
    }


    /**
     *
     */
    protected function runComposerUpdate() : void
    {
        $composer_home = self::srPluginGenerator()->generator()->getDataFolder() . "/composer";

        ilUtil::makeDirParents($composer_home);

        exec("export COMPOSER_HOME=" . escapeshellarg($composer_home) . "&&composer update -d " . escapeshellarg($this->temp_dir) . "&&composer du -d " . escapeshellarg($this->temp_dir));

        if (!$this->options->isEnableAutogeneratePluginPhpAndXmlScript()) {
            GeneratePluginPhpAndXml::getInstance()->doGeneratePluginPhpAndXml($this->temp_dir, $this->options->getInitPluginVersion(), $this->extra["ilias_plugin"]);
        }

        if ($this->isSragPlugin() && !$this->options->isEnableAutogeneratePluginReadmeScript()) {
            GeneratePluginReadme::getInstance()->doGeneratePluginReadme($this->temp_dir, self::GENERATE_PLUGIN_README_TEMPLATE, $this->options->getInitPluginVersion(), $this->extra["ilias_plugin"]);
        }
    }


    /**
     *
     */
    protected function zip() : void
    {
        ilUtil::zip($this->temp_base_dir, $this->temp_file, true);

        ilUtil::delDir($this->temp_base_dir);
    }
}
