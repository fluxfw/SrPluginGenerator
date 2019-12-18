<?php

namespace __NAMESPACE__\Object;

use ActiveRecord;
use arConnector;
use il__PLUGIN_NAME__Plugin;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class Obj__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Object
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  __RESPONSIBLE_NAME__ <__RESPONSIBLE_EMAIL__>
 */
class Obj extends ActiveRecord
{

    use DICTrait;
    const TABLE_NAME = "rep_robj___PLUGIN_ID___obj";
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;


    /**
     * @return string
     */
    public function getConnectorContainerName() : string
    {
        return self::TABLE_NAME;
    }


    /**
     * @return string
     *
     * @deprecated
     */
    public static function returnDbTableName() : string
    {
        return self::TABLE_NAME;
    }


    /**
     * @param int $obj_id
     *
     * @return self|null
     */
    public static function getObjectById(int $obj_id)/*: ?self*/
    {
        /**
         * @var self|null $object
         */

        $object = self::where([
            "obj_id" => $obj_id
        ])->first();

        return $object;
    }


    /**
     * @var int
     *
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       8
     * @con_is_notnull   true
     * @con_is_primary   true
     */
    protected $obj_id;
    /**
     * @var bool
     *
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       1
     * @con_is_notnull   true
     */
    protected $is_online = false;


    /**
     * Obj constructor
     *
     * @param int              $primary_key_value
     * @param arConnector|null $connector
     */
    public function __construct($primary_key_value = 0, arConnector $connector = null)
    {
        parent::__construct($primary_key_value, $connector);
    }


    /**
     * @param string $field_name
     *
     * @return mixed|null
     */
    public function sleep(/*string*/
        $field_name
    ) {
        $field_value = $this->{$field_name};

        switch ($field_name) {
            case "is_online":
                return ($field_value ? 1 : 0);
                break;

            default:
                return null;
        }
    }


    /**
     * @param string $field_name
     * @param mixed  $field_value
     *
     * @return mixed|null
     */
    public function wakeUp(/*string*/
        $field_name,
        $field_value
    ) {
        switch ($field_name) {
            case "obj_id":
                return intval($field_value);
                break;

            case "is_online":
                return boolval($field_value);
                break;

            default:
                return null;
        }
    }


    /**
     * @return int
     */
    public function getObjId() : int
    {
        return $this->obj_id;
    }


    /**
     * @param int $obj_id
     */
    public function setObjId(int $obj_id)/*: void*/
    {
        $this->obj_id = $obj_id;
    }


    /**
     * @return bool
     */
    public function isOnline() : bool
    {
        return $this->is_online;
    }


    /**
     * @param bool $is_online
     */
    public function setOnline(bool $is_online = true)/*: void*/
    {
        $this->is_online = $is_online;
    }
}