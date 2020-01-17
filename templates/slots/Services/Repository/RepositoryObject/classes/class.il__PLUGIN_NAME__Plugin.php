<?php

require_once __DIR__ . "/../vendor/autoload.php";

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\DIC\__PLUGIN_NAME__\Util\LibraryLanguageInstaller;
use srag\RemovePluginDataConfirm\__PLUGIN_NAME__\RepositoryObjectPluginUninstallTrait;

/**
 * Class il__PLUGIN_NAME__Plugin__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class il__PLUGIN_NAME__Plugin extends ilRepositoryObjectPlugin
{

    use RepositoryObjectPluginUninstallTrait;
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
    public function updateLanguages(/*?array*/ $a_lang_keys = null)/*:void*/
    {
        parent::updateLanguages($a_lang_keys);

        LibraryLanguageInstaller::getInstance()->withPlugin(self::plugin())->withLibraryLanguageDirectory(__DIR__
            . "/../vendor/srag/removeplugindataconfirm/lang")->updateLanguages();
    }


    /**
     * @inheritDoc
     */
    protected function deleteData()/*: void*/
    {
        self::__PLUGIN_NAME_CAMEL_CASE__()->dropTables();
    }
}
