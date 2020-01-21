<?php

namespace __NAMESPACE__\Job;

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class Repository__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Job
 *
 * __AUTHOR_COMMENT__
 */
final class Repository
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
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

    }


    /**
     * @return Factory
     */
    public function factory() : Factory
    {
        return Factory::getInstance();
    }


    /**
     * @internal
     */
    public function installTables()/*: void*/
    {

    }
}
