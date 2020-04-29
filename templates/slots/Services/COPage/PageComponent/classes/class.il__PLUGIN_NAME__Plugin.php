<?php

require_once __DIR__ . "/../vendor/autoload.php";

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\RemovePluginDataConfirm\__PLUGIN_NAME__\PluginUninstallTrait;

/**
 * Class il__PLUGIN_NAME__Plugin__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class il__PLUGIN_NAME__Plugin extends ilPageComponentPlugin
{

    use PluginUninstallTrait;
    use __PLUGIN_NAME__Trait;
    const PLUGIN_ID = "__PLUGIN_ID__";
    const PLUGIN_NAME = "__PLUGIN_NAME__";
    const PLUGIN_CLASS_NAME = self::class;
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
     * @inheritDoc
     */
    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
    }


    /**
     * @inheritDoc
     */
    public function isValidParentType(/*string*/ $a_type) : bool
    {
        // Allow in all parent types
        return true;
    }


    /**
     * @inheritDoc
     */
    public function onDelete(/*array*/ $properties, /*string*/ $plugin_version)/* : void*/
    {
        if (self::dic()->ctrl()->getCmd() !== "moveAfter") {

        }
    }


    /**
     * @inheritDoc
     */
    public function onClone(/*array*/ &$properties, /*string*/ $plugin_version) : void
    {

    }


    /**
     * @inheritDoc
     */
    public function updateLanguages(/*?array*/ $a_lang_keys = null)/* : void*/
    {
        parent::updateLanguages($a_lang_keys);

        $this->installRemovePluginDataConfirmLanguages();
    }


    /**
     * @inheritDoc
     */
    protected function deleteData()/* : void*/
    {
        self::__PLUGIN_NAME_CAMEL_CASE__()->dropTables();
    }
}
