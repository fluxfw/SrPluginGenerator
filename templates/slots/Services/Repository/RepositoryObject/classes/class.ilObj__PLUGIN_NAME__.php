<?php

use __NAMESPACE__\ObjectSettings\ObjectSettings;
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
     * @var ObjectSettings
     */
    protected $object_settings;


    /**
     * ilObj__PLUGIN_NAME__ constructor
     *
     * @param int $a_ref_id
     */
    public function __construct(/*int*/ $a_ref_id = 0)
    {
        parent::__construct($a_ref_id);
    }


    /**
     * @inheritDoc
     */
    public final function initType()/*: void*/
    {
        $this->setType(il__PLUGIN_NAME__Plugin::PLUGIN_ID);
    }


    /**
     * @inheritDoc
     */
    public function doCreate()/*: void*/
    {
        $this->object_settings = new ObjectSettings();

        $this->object_settings->setObjId($this->id);

        $this->object_settings->store();
    }


    /**
     * @inheritDoc
     */
    public function doRead()/*: void*/
    {
        $this->object_settings = ObjectSettings::getObjectSettingsById(intval($this->id));
    }


    /**
     * @inheritDoc
     */
    public function doUpdate()/*: void*/
    {
        $this->object_settings->store();
    }


    /**
     * @inheritDoc
     */
    public function doDelete()/*: void*/
    {
        if ($this->object_settings !== null) {
            $this->object_settings->delete();
        }
    }


    /**
     * @inheritDoc
     *
     * @param ilObj__PLUGIN_NAME__ $new_obj
     */
    protected function doCloneObject(/*ilObj__PLUGIN_NAME__*/ $new_obj, /*int*/ $a_target_id, /*?int*/ $a_copy_id = null)/*: void*/
    {
        $new_obj->object_settings = $this->object_settings->copy();

        $new_obj->object_settings->setObjId($new_obj->id);

        $new_obj->object_settings->store();
    }


    /**
     * @return bool
     */
    public function isOnline() : bool
    {
        return $this->object_settings->isOnline();
    }


    /**
     * @param bool $is_online
     */
    public function setOnline(bool $is_online = true)/*: void*/
    {
        $this->object_settings->setOnline($is_online);
    }
}
