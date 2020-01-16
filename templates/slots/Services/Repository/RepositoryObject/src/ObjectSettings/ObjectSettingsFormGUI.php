<?php

namespace __NAMESPACE__\ObjectSettings;

use il__PLUGIN_NAME__Plugin;
use ilCheckboxInputGUI;
use ilObj__PLUGIN_NAME__;
use ilObj__PLUGIN_NAME__GUI;
use ilTextAreaInputGUI;
use ilTextInputGUI;
use srag\CustomInputGUIs\__PLUGIN_NAME__\PropertyFormGUI\PropertyFormGUI;
use srag\CustomInputGUIs\PropertyFormGUI\Items\Items;

/**
 * Class ObjectSettingsFormGUI__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\ObjectSettings
 *
 * __AUTHOR_COMMENT__
 */
class ObjectSettingsFormGUI extends PropertyFormGUI
{

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const LANG_MODULE = ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS;
    /**
     * @var ilObj__PLUGIN_NAME__
     */
    protected $object;


    /**
     * ObjectSettingsFormGUI constructor
     *
     * @param ilObj__PLUGIN_NAME__GUI $parent
     * @param ilObj__PLUGIN_NAME__    $object
     */
    public function __construct(ilObj__PLUGIN_NAME__GUI $parent, ilObj__PLUGIN_NAME__ $object)
    {
        $this->object = $object;

        parent::__construct($parent, $object);
    }


    /**
     * @inheritDoc
     */
    protected function getValue(/*string*/ $key)
    {
        switch ($key) {
            case "description":
                return Items::getter($this->object, "long_description");

            default:
                return Items::getter($this->object, $key);
        }
    }


    /**
     * @inheritDoc
     */
    protected function initCommands()/*: void*/
    {
        $this->addCommandButton(ilObj__PLUGIN_NAME__GUI::CMD_SETTINGS_STORE, self::plugin()->translate("save", self::LANG_MODULE));

        $this->addCommandButton(ilObj__PLUGIN_NAME__GUI::CMD_MANAGE_CONTENTS, self::plugin()->translate("cancel", self::LANG_MODULE));
    }


    /**
     * @inheritDoc
     */
    protected function initFields()/*: void*/
    {
        $this->fields = [
            "title"       => [
                self::PROPERTY_CLASS    => ilTextInputGUI::class,
                self::PROPERTY_REQUIRED => true
            ],
            "description" => [
                self::PROPERTY_CLASS    => ilTextAreaInputGUI::class,
                self::PROPERTY_REQUIRED => false
            ],
            "online"      => [
                self::PROPERTY_CLASS => ilCheckboxInputGUI::class
            ]
        ];
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
        $this->setTitle(self::plugin()->translate("settings", self::LANG_MODULE));
    }


    /**
     * @inheritDoc
     */
    protected function storeValue(/*string*/ $key, $value)/*: void*/
    {
        switch ($key) {
            default:
                Items::setter($this->object, $key, $value);
                break;
        }
    }


    /**
     * @inheritDoc
     */
    public function storeForm() : bool
    {
        if (!parent::storeForm()) {
            return false;
        }

        $this->object->update();

        return true;
    }
}
