<?php

namespace srag\Plugins\SrPluginGenerator\Config;

use ilSrPluginGeneratorPlugin;
use srag\ActiveRecordConfig\SrPluginGenerator\Config\AbstractFactory;
use srag\ActiveRecordConfig\SrPluginGenerator\Config\AbstractRepository;
use srag\ActiveRecordConfig\SrPluginGenerator\Config\Config;
use srag\Plugins\SrPluginGenerator\Config\Form\FormBuilder;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Repository
 *
 * @package srag\Plugins\SrPluginGenerator\Config
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Repository extends AbstractRepository
{

    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
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
            FormBuilder::KEY_ROLES => [Config::TYPE_JSON, []]
        ];
    }


    /**
     * @inheritDoc
     */
    protected function getTableName() : string
    {
        return "srplgen_config";
    }
}
