<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilSrPluginGeneratorPlugin;
use ilUtil;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Repository
 *
 * @package srag\Plugins\SrPluginGenerator\Generator
 */
final class Repository
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Repository constructor
     */
    private function __construct()
    {

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
     * @internal
     */
    public function dropTables() : void
    {
        ilUtil::delDir($this->getDataFolder());
        ilUtil::delDir($this->getTempFolder());
    }


    /**
     * @return Factory
     */
    public function factory() : Factory
    {
        return Factory::getInstance();
    }


    /**
     * @return string
     */
    public function getDataFolder() : string
    {
        return CLIENT_DATA_DIR . "/" . ilSrPluginGeneratorPlugin::PLUGIN_ID;
    }


    /**
     * @return string
     */
    public function getLink() : string
    {
        return ILIAS_HTTP_PATH . "/goto.php?target=uihk_" . ilSrPluginGeneratorPlugin::PLUGIN_ID;
    }


    /**
     * @return string
     */
    public function getTempFolder() : string
    {
        return CLIENT_DATA_DIR . "/temp/" . ilSrPluginGeneratorPlugin::PLUGIN_ID;
    }


    /**
     * @internal
     */
    public function installTables() : void
    {

    }


    /**
     * @return Slots
     */
    public function slots() : Slots
    {
        return Slots::getInstance();
    }
}
