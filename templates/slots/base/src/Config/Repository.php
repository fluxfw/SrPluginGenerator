<?php

namespace __NAMESPACE__\Config;

use __NAMESPACE__\Config\Form\FormBuilder;
use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use il__PLUGIN_NAME__Plugin;
use srag\ActiveRecordConfig\__PLUGIN_NAME__\Config\AbstractFactory;
use srag\ActiveRecordConfig\__PLUGIN_NAME__\Config\AbstractRepository;
use srag\ActiveRecordConfig\__PLUGIN_NAME__\Config\Config;

/**
 * Class Repository__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Config
 *
 * __AUTHOR_COMMENT__
 */
final class Repository extends AbstractRepository
{

    use __PLUGIN_NAME__Trait;

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Repository constructor
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
     * @inheritDoc
     *
     * @return Factory
     */
    public function factory() : AbstractFactory
    {
        return Factory::getInstance();
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        return [
            FormBuilder::KEY_SOME => Config::TYPE_STRING
        ];
    }


    /**
     * @inheritDoc
     */
    protected function getTableName() : string
    {
        return il__PLUGIN_NAME__Plugin::PLUGIN_ID . "_config";
    }
}
