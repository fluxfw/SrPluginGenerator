<?php

require_once __DIR__ . "/../vendor/autoload.php";

use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Provider\PluginProviderCollection;
use srag\CustomInputGUIs\SrPluginGenerator\Loader\CustomInputGUIsLoaderDetector;
use srag\DevTools\SrPluginGenerator\DevToolsCtrl;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;
use srag\RemovePluginDataConfirm\SrPluginGenerator\PluginUninstallTrait;

/**
 * Class ilSrPluginGeneratorPlugin
 */
class ilSrPluginGeneratorPlugin extends ilUserInterfaceHookPlugin
{

    use PluginUninstallTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = self::class;
    const PLUGIN_ID = "srplugingenerator";
    const PLUGIN_NAME = "SrPluginGenerator";
    /**
     * @var self|null
     */
    protected static $instance = null;
    /**
     * @var PluginProviderCollection|null
     */
    protected static $pluginProviderCollection = null;


    /**
     * ilSrPluginGeneratorPlugin constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->provider_collection = self::getPluginProviderCollection(); // Fix overflow
    }


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
     * @return PluginProviderCollection
     */
    protected static function getPluginProviderCollection() : PluginProviderCollection
    {
        if (self::$pluginProviderCollection === null) {
            self::$pluginProviderCollection = new PluginProviderCollection();

            self::$pluginProviderCollection->setMainBarProvider(self::srPluginGenerator()->menu());
        }

        return self::$pluginProviderCollection;
    }


    /**
     * @inheritDoc
     */
    public function exchangeUIRendererAfterInitialization(Container $dic) : Closure
    {
        return CustomInputGUIsLoaderDetector::exchangeUIRendererAfterInitialization();
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
    public function updateLanguages(/*?array*/ $a_lang_keys = null) : void
    {
        parent::updateLanguages($a_lang_keys);

        $this->installRemovePluginDataConfirmLanguages();

        DevToolsCtrl::installLanguages(self::plugin());
    }


    /**
     * @inheritDoc
     */
    protected function deleteData() : void
    {
        self::srPluginGenerator()->dropTables();
    }


    /**
     * @inheritDoc
     */
    protected function shouldUseOneUpdateStepOnly() : bool
    {
        return true;
    }
}
