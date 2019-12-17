<?php

namespace srag\Plugins\SrPluginGenerator\PluginGenerator;

use ilSrPluginGeneratorPlugin;
use ilUtil;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Repository
 *
 * @package srag\Plugins\SrPluginGenerator\PluginGenerator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Repository
{

    use DICTrait;
    use SrPluginGeneratorTrait;
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    /**
     * @var self
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
     * Repository constructor
     */
    private function __construct()
    {

    }


    /**
     * @internal
     */
    public function dropTables()/*: void*/
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
    public function getTempFolder() : string
    {
        return CLIENT_DATA_DIR . "/temp/" . ilSrPluginGeneratorPlugin::PLUGIN_ID;
    }


    /**
     * @internal
     */
    public function installTables()/*: void*/
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
