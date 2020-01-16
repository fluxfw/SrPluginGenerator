<?php

namespace __NAMESPACE__\Config;

use il__PLUGIN_NAME__ConfigGUI;
use il__PLUGIN_NAME__Plugin;
use ilTextInputGUI;
use srag\ActiveRecordConfig\__PLUGIN_NAME__\Config\Config;
use srag\ActiveRecordConfig\__PLUGIN_NAME__\Utils\ConfigTrait;
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

    use ConfigTrait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const KEY_SOME = "some";
    const LANG_MODULE = il__PLUGIN_NAME__ConfigGUI::LANG_MODULE;
    /**
     * @var bool
     */
    protected static $init_config = false;


    /**
     *
     */
    public static function initConfig()/*:void*/
    {
        if (!self::$init_config) {
            self::$init_config = true;

            self::config()->withTableName(il__PLUGIN_NAME__Plugin::PLUGIN_ID . "_config")->withFields([
                self::KEY_SOME => Config::TYPE_STRING
            ]);
            // TODO: Implement Config
        }
    }


    /**
     * ConfigFormGUI constructor
     *
     * @param il__PLUGIN_NAME__ConfigGUI $parent
     */
    public function __construct(il__PLUGIN_NAME__ConfigGUI $parent)
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
                return self::config()->getField($key);
        }
    }


    /**
     * @inheritDoc
     */
    protected function initCommands()/*: void*/
    {
        $this->addCommandButton(il__PLUGIN_NAME__ConfigGUI::CMD_UPDATE_CONFIGURE, $this->txt("save"));
    }


    /**
     * @inheritDoc
     */
    protected function initFields()/*: void*/
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
    protected function initId()/*: void*/
    {

    }


    /**
     * @inheritDoc
     */
    protected function initTitle()/*: void*/
    {
        $this->setTitle($this->txt("configuration"));
    }


    /**
     * @inheritDoc
     */
    protected function storeValue(/*string*/ $key, $value)/*: void*/
    {
        switch ($key) {
            default:
                self::config()->setField($key, $value);
                break;
        }
    }
}
