<?php

namespace srag\Plugins\SrPluginGenerator\Config;

use ilSrPluginGeneratorConfigGUI;
use ilSrPluginGeneratorPlugin;
use srag\ActiveRecordConfig\SrPluginGenerator\Config\AbstractFactory;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Factory
 *
 * @package srag\Plugins\SrPluginGenerator\Config
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory extends AbstractFactory
{

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
     * Factory constructor
     */
    protected function __construct()
    {
        parent::__construct();
    }


    /**
     * @param ilSrPluginGeneratorConfigGUI $parent
     *
     * @return ConfigFormGUI
     */
    public function newFormInstance(ilSrPluginGeneratorConfigGUI $parent) : ConfigFormGUI
    {
        $form = new ConfigFormGUI($parent);

        return $form;
    }
}
