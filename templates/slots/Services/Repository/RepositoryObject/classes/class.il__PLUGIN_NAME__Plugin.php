<?php

require_once __DIR__ . "/../vendor/autoload.php";

use __NAMESPACE__\Config\Config;
use __NAMESPACE__\ObjectSettings\ObjectSettings;
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
     * @return string
     */
    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
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
        self::dic()->database()->dropTable(ObjectSettings::TABLE_NAME, false);
    }
}
