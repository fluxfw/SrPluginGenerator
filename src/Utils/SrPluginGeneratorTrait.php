<?php

namespace srag\Plugins\SrPluginGenerator\Utils;

use srag\Plugins\SrPluginGenerator\Repository;

/**
 * Trait SrPluginGeneratorTrait
 *
 * @package srag\Plugins\SrPluginGenerator\Utils
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
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
