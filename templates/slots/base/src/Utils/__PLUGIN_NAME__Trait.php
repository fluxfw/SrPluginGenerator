<?php

namespace __NAMESPACE__\Utils;

use __NAMESPACE__\Repository;

/**
 * Trait __PLUGIN_NAME__Trait__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Utils
 *
 * __AUTHOR_COMMENT__
 */
trait __PLUGIN_NAME__Trait
{

    /**
     * @return Repository
     */
    protected static function __PLUGIN_NAME_CAMEL_CASE__() : Repository
    {
        return Repository::getInstance();
    }
}
