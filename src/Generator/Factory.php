<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Generator\Form\FormBuilder;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Factory
 *
 * @package srag\Plugins\SrPluginGenerator\Generator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
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
     * @return FormBuilder
     */
    public function newFormBuilderInstance(PluginGeneratorGUI $parent, Options $options) : FormBuilder
    {
        $form = new FormBuilder($parent, $options);

        return $form;
    }


    /**
     * @param Options $options
     *
     * @return Generator
     */
    public function newGeneratorInstance(Options $options) : Generator
    {
        $generator = new Generator($options);

        return $generator;
    }
}
