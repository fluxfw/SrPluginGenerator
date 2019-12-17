<?php

require_once __DIR__ . "/../vendor/autoload.php";

use __NAMESPACE__\Config\Config;
use srag\DIC\__PLUGIN_NAME__\Util\LibraryLanguageInstaller;
use srag\RemovePluginDataConfirm\__PLUGIN_NAME__\PluginUninstallTrait;

/**
 * Class il__PLUGIN_NAME__Plugin__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class il__PLUGIN_NAME__Plugin extends ilPageComponentPlugin
{

    use PluginUninstallTrait;
    const PLUGIN_ID = "__PLUGIN_ID__";
    const PLUGIN_NAME = "__PLUGIN_NAME__";
    const PLUGIN_CLASS_NAME = self::class;
    const REMOVE_PLUGIN_DATA_CONFIRM_CLASS_NAME = __PLUGIN_NAME__RemoveDataConfirm::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * il__PLUGIN_NAME__Plugin constructor
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return string
     */
    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
    }


    /**
     * @param string $a_type
     *
     * @return bool
     */
    public function isValidParentType($a_type) : bool
    {
        // Allow in all parent types
        return true;
    }


    /**
     * @param array  $properties
     * @param string $plugin_version
     *
     * @since ILIAS 5.3
     */
    public function onDelete(/*array*/
        $properties, /*string*/
        $plugin_version
    )/*: void*/
    {
        if (self::dic()->ctrl()->getCmd() !== "moveAfter") {

        }
    }


    /**
     * @param array  $properties
     * @param string $plugin_version
     *
     * @since ILIAS 5.3
     */
    public function onClone(/*array*/
        &$properties, /*string*/
        $plugin_version
    )/*: void*/
    {
    }


    /**
     * @inheritdoc
     */
    public function updateLanguages($a_lang_keys = null)
    {
        parent::updateLanguages($a_lang_keys);

        LibraryLanguageInstaller::getInstance()->withPlugin(self::plugin())->withLibraryLanguageDirectory(__DIR__
            . "/../vendor/srag/removeplugindataconfirm/lang")->updateLanguages();
    }


    /**
     * @inheritdoc
     */
    protected function deleteData()/*: void*/
    {
        self::dic()->database()->dropTable(Config::TABLE_NAME, false);
    }
}
