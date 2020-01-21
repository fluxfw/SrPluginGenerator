<?php

require_once __DIR__ . "/../vendor/autoload.php";

use ILIAS\GlobalScreen\Scope\MainMenu\Provider\AbstractStaticPluginMainMenuProvider;
use srag\Plugins\SrPluginGenerator\Menu\Menu;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;
use srag\RemovePluginDataConfirm\SrPluginGenerator\PluginUninstallTrait;

/**
 * Class ilSrPluginGeneratorPlugin
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilSrPluginGeneratorPlugin extends ilUserInterfaceHookPlugin
{

    use PluginUninstallTrait;
    use SrPluginGeneratorTrait;
    const PLUGIN_ID = "srplugingenerator";
    const PLUGIN_NAME = "SrPluginGenerator";
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
     * ilSrPluginGeneratorPlugin constructor
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
    public function promoteGlobalScreenProvider() : AbstractStaticPluginMainMenuProvider
    {
        return new Menu(self::dic()->dic(), $this);
    }


    /**
     * @inheritDoc
     */
    public function updateLanguages(/*?array*/ $a_lang_keys = null)/*:void*/
    {
        parent::updateLanguages($a_lang_keys);

        $this->installRemovePluginDataConfirmLanguages();
    }


    /**
     * @inheritDoc
     */
    protected function deleteData()/*: void*/
    {
        self::srPluginGenerator()->dropTables();
    }
}
