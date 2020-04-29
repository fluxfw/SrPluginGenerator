<?php

namespace __NAMESPACE__\Config;

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use il__PLUGIN_NAME__Plugin;
use ilTextInputGUI;
use srag\ActiveRecordConfig\__PLUGIN_NAME__\Config\Config;
use srag\CustomInputGUIs\__PLUGIN_NAME__\PropertyFormGUI\PropertyFormGUI;

/**
 * Class ConfigFormGUI__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Config
 *
 * __AUTHOR_COMMENT__
 */
class ConfigFormGUI extends PropertyFormGUI
{

    use __PLUGIN_NAME__Trait;

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const KEY_SOME = "some";
    const LANG_MODULE = ConfigCtrl::LANG_MODULE;


    /**
     * ConfigFormGUI constructor
     *
     * @param ConfigCtrl $parent
     */
    public function __construct(ConfigCtrl $parent)
    {
        parent::__construct($parent);
    }


    /**
     * @inheritDoc
     */
    protected function getValue(/*string*/ $key)
    {
        switch ($key) {
            default:
                return self::__PLUGIN_NAME_CAMEL_CASE__()->config()->getValue($key);
        }
    }


    /**
     * @inheritDoc
     */
    protected function initCommands()/* : void*/
    {
        $this->addCommandButton(ConfigCtrl::CMD_UPDATE_CONFIGURE, $this->txt("save"));
    }


    /**
     * @inheritDoc
     */
    protected function initFields()/* : void*/
    {
        $this->fields = [
            self::KEY_SOME => [
                self::PROPERTY_CLASS    => ilTextInputGUI::class,
                self::PROPERTY_REQUIRED => true
            ]
        ];
        // TODO: Implement ConfigFormGUI
    }


    /**
     * @inheritDoc
     */
    protected function initId()/* : void*/
    {

    }


    /**
     * @inheritDoc
     */
    protected function initTitle()/* : void*/
    {
        $this->setTitle($this->txt("configuration"));
    }


    /**
     * @inheritDoc
     */
    protected function storeValue(/*string*/ $key, $value)/* : void*/
    {
        switch ($key) {
            default:
                self::__PLUGIN_NAME_CAMEL_CASE__()->config()->setValue($key, $value);
                break;
        }
    }
}
