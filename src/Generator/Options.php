<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilSrPluginGeneratorPlugin;
use JsonSerializable;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;
use stdClass;

/**
 * Class Options
 *
 * @package srag\Plugins\SrPluginGenerator\Generator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class Options implements JsonSerializable
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const DEFAULT_INIT_PLUGIN_VERSION = "0.1.0";
    const DEFAULT_MAX_ILIAS_VERSION = "6.999";
    const DEFAULT_MIN_ILIAS_VERSION = "5.4.0";
    const DEFAULT_MIN_PHP_VERSION = "7.0";
    const DEFAULT_NAMESPACE = "srag\\Plugins\\__PLUGIN_NAME__\\";
    const DEFAULT_RESPONSIBLE_EMAIL = "support-custom1@studer-raimann.ch";
    const DEFAULT_RESPONSIBLE_NAME = "studer + raimann ag - Team Custom 1";
    const PHP_VERSIONS
        = [
            self::DEFAULT_MIN_PHP_VERSION => self::DEFAULT_MIN_PHP_VERSION,
            "7.2"                         => "7.2"
        ];
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    /**
     * @var bool
     */
    protected $enable_autogenerate_plugin_php_and_xml_script = false;
    /**
     * @var bool
     */
    protected $enable_autogenerate_plugin_readme_script = false;
    /**
     * @var bool
     */
    protected $enable_dev_tools = false;
    /**
     * @var bool
     */
    protected $enable_librariesnamespacechanger_script = true;
    /**
     * @var bool
     */
    protected $enable_min_php_version_checker = false;
    /**
     * @var bool
     */
    protected $enable_php72backport_script = false;
    /**
     * @var bool
     */
    protected $enable_should_use_one_update_step_only = false;
    /**
     * @var bool
     */
    protected $enable_update_plugin_readme_script = false;
    /**
     * @var string
     */
    protected $init_plugin_version = self::DEFAULT_INIT_PLUGIN_VERSION;
    /**
     * @var string
     */
    protected $max_ilias_version = self::DEFAULT_MAX_ILIAS_VERSION;
    /**
     * @var string
     */
    protected $min_ilias_version = self::DEFAULT_MIN_ILIAS_VERSION;
    /**
     * @var string
     */
    protected $min_php_version = self::DEFAULT_MIN_PHP_VERSION;
    /**
     * @var string
     */
    protected $namespace = self::DEFAULT_NAMESPACE;
    /**
     * @var string
     */
    protected $plugin_id = "";
    /**
     * @var string
     */
    protected $plugin_name = "";
    /**
     * @var string
     */
    protected $plugin_slot = "";
    /**
     * @var string
     */
    protected $project_key = "";
    /**
     * @var string
     */
    protected $responsible_email = self::DEFAULT_RESPONSIBLE_EMAIL;
    /**
     * @var string
     */
    protected $responsible_name = self::DEFAULT_RESPONSIBLE_NAME;


    /**
     * Options constructor
     */
    public function __construct()
    {

    }


    /**
     * @return string
     */
    public function getInitPluginVersion() : string
    {
        return $this->init_plugin_version;
    }


    /**
     * @param string $init_plugin_version
     */
    public function setInitPluginVersion(string $init_plugin_version)/* : void*/
    {
        $this->init_plugin_version = $init_plugin_version;
    }


    /**
     * @return string
     */
    public function getMaxIliasVersion() : string
    {
        return $this->max_ilias_version;
    }


    /**
     * @param string $max_ilias_version
     */
    public function setMaxIliasVersion(string $max_ilias_version)/* : void*/
    {
        $this->max_ilias_version = $max_ilias_version;
    }


    /**
     * @return string
     */
    public function getMinIliasVersion() : string
    {
        return $this->min_ilias_version;
    }


    /**
     * @param string $min_ilias_version
     */
    public function setMinIliasVersion(string $min_ilias_version)/* : void*/
    {
        $this->min_ilias_version = $min_ilias_version;
    }


    /**
     * @return string
     */
    public function getMinPhpVersion() : string
    {
        return $this->min_php_version;
    }


    /**
     * @param string $min_php_version
     */
    public function setMinPhpVersion(string $min_php_version)/* : void*/
    {
        $this->min_php_version = $min_php_version;
    }


    /**
     * @return string
     */
    public function getNamespace() : string
    {
        return $this->namespace;
    }


    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace)/*: void*/
    {
        $this->namespace = $namespace;
    }


    /**
     * @return string
     */
    public function getPluginId() : string
    {
        return $this->plugin_id;
    }


    /**
     * @param string $plugin_id
     */
    public function setPluginId(string $plugin_id)/*: void*/
    {
        $this->plugin_id = $plugin_id;
    }


    /**
     * @return string
     */
    public function getPluginName() : string
    {
        return $this->plugin_name;
    }


    /**
     * @param string $plugin_name
     */
    public function setPluginName(string $plugin_name)/*: void*/
    {
        $this->plugin_name = $plugin_name;
    }


    /**
     * @return string
     */
    public function getPluginSlot() : string
    {
        return $this->plugin_slot;
    }


    /**
     * @param string $plugin_slot
     */
    public function setPluginSlot(string $plugin_slot)/*: void*/
    {
        $this->plugin_slot = $plugin_slot;
    }


    /**
     * @return string
     */
    public function getProjectKey() : string
    {
        return $this->project_key;
    }


    /**
     * @param string $project_key
     */
    public function setProjectKey(string $project_key)/*: void*/
    {
        $this->project_key = $project_key;
    }


    /**
     * @return string
     */
    public function getResponsibleEmail() : string
    {
        return $this->responsible_email;
    }


    /**
     * @param string $responsible_email
     */
    public function setResponsibleEmail(string $responsible_email)/*: void*/
    {
        $this->responsible_email = $responsible_email;
    }


    /**
     * @return string
     */
    public function getResponsibleName() : string
    {
        return $this->responsible_name;
    }


    /**
     * @param string $responsible_name
     */
    public function setResponsibleName(string $responsible_name)/*: void*/
    {
        $this->responsible_name = $responsible_name;
    }


    /**
     * @return bool
     */
    public function isEnableAutogeneratePluginPhpAndXmlScript() : bool
    {
        return $this->enable_autogenerate_plugin_php_and_xml_script;
    }


    /**
     * @param bool $enable_autogenerate_plugin_php_and_xml_script
     */
    public function setEnableAutogeneratePluginPhpAndXmlScript(bool $enable_autogenerate_plugin_php_and_xml_script)/*: void*/
    {
        $this->enable_autogenerate_plugin_php_and_xml_script = $enable_autogenerate_plugin_php_and_xml_script;
    }


    /**
     * @return bool
     */
    public function isEnableAutogeneratePluginReadmeScript() : bool
    {
        return $this->enable_autogenerate_plugin_readme_script;
    }


    /**
     * @param bool $enable_autogenerate_plugin_readme_script
     */
    public function setEnableAutogeneratePluginReadmeScript(bool $enable_autogenerate_plugin_readme_script)/* : void*/
    {
        $this->enable_autogenerate_plugin_readme_script = $enable_autogenerate_plugin_readme_script;
    }


    /**
     * @return bool
     */
    public function isEnableDevTools() : bool
    {
        return $this->enable_dev_tools;
    }


    /**
     * @param bool $enable_dev_tools
     */
    public function setEnableDevTools(bool $enable_dev_tools)/*: void*/
    {
        $this->enable_dev_tools = $enable_dev_tools;
    }


    /**
     * @return bool
     */
    public function isEnableLibrariesnamespacechangerScript() : bool
    {
        return $this->enable_librariesnamespacechanger_script;
    }


    /**
     * @param bool $enable_librariesnamespacechanger_script
     */
    public function setEnableLibrariesnamespacechangerScript(bool $enable_librariesnamespacechanger_script)/* : void*/
    {
        $this->enable_librariesnamespacechanger_script = $enable_librariesnamespacechanger_script;
    }


    /**
     * @return bool
     */
    public function isEnableMinPhpVersionChecker() : bool
    {
        return $this->enable_min_php_version_checker;
    }


    /**
     * @param bool $enable_min_php_version_checker
     */
    public function setEnableMinPhpVersionChecker(bool $enable_min_php_version_checker)/*: void*/
    {
        $this->enable_min_php_version_checker = $enable_min_php_version_checker;
    }


    /**
     * @return bool
     */
    public function isEnablePhp72backportScript() : bool
    {
        if ($this->min_php_version === self::DEFAULT_MIN_PHP_VERSION) {
            return true;
        }

        return $this->enable_php72backport_script;
    }


    /**
     * @param bool $enable_php72backport_script
     */
    public function setEnablePhp72backportScript(bool $enable_php72backport_script)/* : void*/
    {
        $this->enable_php72backport_script = $enable_php72backport_script;
    }


    /**
     * @return bool
     */
    public function isEnableShouldUseOneUpdateStepOnly() : bool
    {
        return $this->enable_should_use_one_update_step_only;
    }


    /**
     * @param bool $enable_should_use_one_update_step_only
     */
    public function setEnableShouldUseOneUpdateStepOnly(bool $enable_should_use_one_update_step_only)/*: void*/
    {
        $this->enable_should_use_one_update_step_only = $enable_should_use_one_update_step_only;
    }


    /**
     * @return bool
     */
    public function isEnableUpdatePluginReadmeScript() : bool
    {
        return $this->enable_update_plugin_readme_script;
    }


    /**
     * @param bool $enable_update_plugin_readme_script
     */
    public function setEnableUpdatePluginReadmeScript(bool $enable_update_plugin_readme_script)/* : void*/
    {
        $this->enable_update_plugin_readme_script = $enable_update_plugin_readme_script;
    }


    /**
     * @inheritDoc
     *
     * @return stdClass
     */
    public function jsonSerialize() : stdClass
    {
        return (object) get_object_vars($this);
    }
}
