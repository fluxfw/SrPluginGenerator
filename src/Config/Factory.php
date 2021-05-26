<?php

namespace srag\Plugins\SrPluginGenerator\Config;

use ilSrPluginGeneratorPlugin;
use srag\ActiveRecordConfig\SrPluginGenerator\Config\AbstractFactory;
use srag\Plugins\SrPluginGenerator\Config\Form\FormBuilder;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Factory
 *
 * @package srag\Plugins\SrPluginGenerator\Config
 */
final class Factory extends AbstractFactory
{

    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Factory constructor
     */
    protected function __construct()
    {
        parent::__construct();
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
     * @param ConfigCtrl $parent
     *
     * @return FormBuilder
     */
    public function newFormBuilderInstance(ConfigCtrl $parent) : FormBuilder
    {
        $form = new FormBuilder($parent);

        return $form;
    }
}
