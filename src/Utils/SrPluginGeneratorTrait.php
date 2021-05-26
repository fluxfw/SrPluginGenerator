<?php

namespace srag\Plugins\SrPluginGenerator\Utils;

use srag\Plugins\SrPluginGenerator\Repository;

/**
 * Trait SrPluginGeneratorTrait
 *
 * @package srag\Plugins\SrPluginGenerator\Utils
 */
trait SrPluginGeneratorTrait
{

    /**
     * @return Repository
     */
    protected static function srPluginGenerator() : Repository
    {
        return Repository::getInstance();
    }
}
