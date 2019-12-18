<?php

use __NAMESPACE__\Object\Obj;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class ilObj__PLUGIN_NAME____VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class ilObj__PLUGIN_NAME__ extends ilObjectPlugin
{

    use DICTrait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    /**
     * @var Obj
     */
    protected $object;


    /**
     * ilObj__PLUGIN_NAME__ constructor
     *
     * @param int $a_ref_id
     */
    public function __construct($a_ref_id = 0)
    {
        parent::__construct($a_ref_id);
    }


    /**
     *
     */
    public final function initType()/*: void*/
    {
        $this->setType(il__PLUGIN_NAME__Plugin::PLUGIN_ID);
    }


    /**
     *
     */
    public function doCreate()/*: void*/
    {
        $this->object = new Obj();

        $this->object->setObjId($this->id);

        $this->object->store();
    }


    /**
     *
     */
    public function doRead()/*: void*/
    {
        $this->object = Obj::getObjectById(intval($this->id));
    }


    /**
     *
     */
    public function doUpdate()/*: void*/
    {
        $this->object->store();
    }


    /**
     *
     */
    public function doDelete()/*: void*/
    {
        if ($this->object !== null) {
            $this->object->delete();
        }
    }


    /**
     * @param ilObj__PLUGIN_NAME__ $new_obj
     * @param int                  $a_target_id
     * @param int                  $a_copy_id
     */
    protected function doCloneObject(/*ilObj__PLUGIN_NAME__*/
        $new_obj, /*int*/
        $a_target_id, /*?int*/
        $a_copy_id = null
    )/*: void*/
    {
        $new_obj->object = $this->object->copy();

        $new_obj->object->setObjId($new_obj->id);

        $new_obj->object->store();
    }


    /**
     * @return bool
     */
    public function isOnline() : bool
    {
        return $this->object->isOnline();
    }


    /**
     * @param bool $is_online
     */
    public function setOnline(bool $is_online = true)/*: void*/
    {
        $this->object->setOnline($is_online);
    }
}