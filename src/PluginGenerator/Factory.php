<?php

namespace srag\Plugins\SrPluginGenerator\PluginGenerator;

use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Factory
 *
 * @package srag\Plugins\SrPluginGenerator\PluginGenerator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory
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
     * Factory constructor
     */
    private function __construct()
    {

    }


    /**
     * @return Options
     */
    public function newOptionsInstance() : Options
    {
        $options = new Options();

        return $options;
    }


    /**
     * @param PluginGeneratorGUI $parent
     * @param Options            $options
     *
     * @return GeneratorFormGUI
     */
    public function newFormInstance(PluginGeneratorGUI $parent, Options $options) : GeneratorFormGUI
    {
        $form = new GeneratorFormGUI($parent, $options);

        return $form;
    }


    /**
     * @param Options $options
     *
     * @return Generator
     */
    public function newGeneratorInstance(Options $options) : Generator
    {
        $options = new Generator($options);

        return $options;
    }
}
