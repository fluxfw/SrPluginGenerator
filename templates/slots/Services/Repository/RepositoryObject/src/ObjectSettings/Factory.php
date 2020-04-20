<?php

namespace __NAMESPACE__\ObjectSettings;

use __NAMESPACE__\ObjectSettings\Form\FormBuilder;
use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use il__PLUGIN_NAME__Plugin;
use ilObj__PLUGIN_NAME__;
use ilObj__PLUGIN_NAME__GUI;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class Factory__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\ObjectSettings
 *
 * __AUTHOR_COMMENT__
 */
final class Factory
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
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
     * @return ObjectSettings
     */
    public function newInstance() : ObjectSettings
    {
        $object_settings = new ObjectSettings();

        return $object_settings;
    }


    /**
     * @param ilObj__PLUGIN_NAME__GUI $parent
     * @param ilObj__PLUGIN_NAME__    $object
     *
     * @return FormBuilder
     */
    public function newFormBuilderInstance(ilObj__PLUGIN_NAME__GUI $parent, ilObj__PLUGIN_NAME__ $object) : FormBuilder
    {
        $form = new FormBuilder($parent, $object);

        return $form;
    }
}
