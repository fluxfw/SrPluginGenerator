<?php

use __NAMESPACE__\ObjectSettings\ObjectSettings;
use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class ilObj__PLUGIN_NAME____VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class ilObj__PLUGIN_NAME__ extends ilObjectPlugin
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;
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

        self::__PLUGIN_NAME_CAMEL_CASE__()->objectSettings()->storeObjectSettings($this->object_settings);
    }


    /**
     * @inheritDoc
     */
    public function doRead()/*: void*/
    {
        $this->object_settings = self::__PLUGIN_NAME_CAMEL_CASE__()->objectSettings()->getObjectSettingsById(intval($this->id));
    }


    /**
     * @inheritDoc
     */
    public function doUpdate()/*: void*/
    {
        self::__PLUGIN_NAME_CAMEL_CASE__()->objectSettings()->storeObjectSettings($this->object_settings);
    }


    /**
     * @inheritDoc
     */
    public function doDelete()/*: void*/
    {
        if ($this->object_settings !== null) {
            self::__PLUGIN_NAME_CAMEL_CASE__()->objectSettings()->deleteObjectSettings($this->object_settings);
        }
    }


    /**
     * @inheritDoc
     *
     * @param ilObj__PLUGIN_NAME__ $new_obj
     */
    protected function doCloneObject(/*ilObj__PLUGIN_NAME__*/ $new_obj, /*int*/ $a_target_id, /*?int*/ $a_copy_id = null)/*: void*/
    {
        $new_obj->object_settings = self::__PLUGIN_NAME_CAMEL_CASE__()->objectSettings()->cloneObjectSettings($this->object_settings);

        $new_obj->object_settings->setObjId($new_obj->id);

        self::__PLUGIN_NAME_CAMEL_CASE__()->objectSettings()->storeObjectSettings($new_obj->object_settings);
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
