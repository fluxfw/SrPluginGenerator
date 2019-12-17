<?php

namespace srag\Plugins\SrPluginGenerator\Config;

use ilSrPluginGeneratorPlugin;
use srag\ActiveRecordConfig\SrPluginGenerator\ActiveRecordConfig;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Config
 *
 * @package srag\Plugins\SrPluginGenerator\Config
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class Config extends ActiveRecordConfig
{

    use SrPluginGeneratorTrait;
    const TABLE_NAME = "srplgen_config";
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const KEY_ROLES = "roles";
    const KEY_ROLES_MENU = "roles_menu";
    /**
     * @var array
     */
    protected static $fields
        = [
            self::KEY_ROLES      => [self::TYPE_JSON, []],
            self::KEY_ROLES_MENU => [self::TYPE_JSON, []]
        ];
}
