<?php

namespace __NAMESPACE__\Config;

use il__PLUGIN_NAME__Plugin;
use srag\ActiveRecordConfig\__PLUGIN_NAME__\ActiveRecordConfig;

/**
 * Class Config__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Config
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  __RESPONSIBLE_NAME__ <__RESPONSIBLE_EMAIL__>
 */
class Config extends ActiveRecordConfig
{

    const TABLE_NAME = "ui_uihk___PLUGIN_ID___config";
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const KEY_SOME = "some";
    /**
     * @var array
     */
    protected static $fields
        = [
            self::KEY_SOME => self::TYPE_STRING
        ];
    // TODO: Implement Config
}
