<?php

namespace __NAMESPACE__\Object;

use il__PLUGIN_NAME__Plugin;
use ilCheckboxInputGUI;
use ilObj__PLUGIN_NAME__GUI;
use ilTextAreaInputGUI;
use ilTextInputGUI;
use srag\CustomInputGUIs\__PLUGIN_NAME__\PropertyFormGUI\ObjectPropertyFormGUI;

/**
 * Class ObjSettingsFormGUI__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Object
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  __RESPONSIBLE_NAME__ <__RESPONSIBLE_EMAIL__>
 */
class ObjSettingsFormGUI extends ObjectPropertyFormGUI
{

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const LANG_MODULE = ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS;


    /**
     * @inheritdoc
     */
    protected function getValue(/*string*/
        $key
    ) {
        switch ($key) {
            case "description":
                return $this->object->getLongDescription();

            default:
                return parent::getValue($key);
        }
    }


    /**
     * @inheritdoc
     */
    protected function initCommands()/*: void*/
    {
        $this->addCommandButton(ilObj__PLUGIN_NAME__GUI::CMD_SETTINGS_STORE, self::plugin()->translate("save", self::LANG_MODULE));

        $this->addCommandButton(ilObj__PLUGIN_NAME__GUI::CMD_MANAGE_CONTENTS, self::plugin()->translate("cancel", self::LANG_MODULE));
    }


    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    protected function initId()/*: void*/
    {

    }


    /**
     * @inheritdoc
     */
    protected function initTitle()/*: void*/
    {
        $this->setTitle(self::plugin()->translate("settings", self::LANG_MODULE));
    }
}
