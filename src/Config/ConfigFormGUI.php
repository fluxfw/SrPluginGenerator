<?php

namespace srag\Plugins\SrPluginGenerator\Config;

use ilMultiSelectInputGUI;
use ilSrPluginGeneratorConfigGUI;
use ilSrPluginGeneratorPlugin;
use srag\CustomInputGUIs\SrPluginGenerator\PropertyFormGUI\PropertyFormGUI;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class ConfigFormGUI
 *
 * @package srag\Plugins\SrPluginGenerator\Config
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ConfigFormGUI extends PropertyFormGUI
{

    use SrPluginGeneratorTrait;
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const KEY_ROLES = "roles";
    const LANG_MODULE = ilSrPluginGeneratorConfigGUI::LANG_MODULE;


    /**
     * ConfigFormGUI constructor
     *
     * @param ilSrPluginGeneratorConfigGUI $parent
     */
    public function __construct(ilSrPluginGeneratorConfigGUI $parent)
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
                return self::srPluginGenerator()->config()->getField($key);
        }
    }


    /**
     * @inheritDoc
     */
    protected function initCommands()/*: void*/
    {
        $this->addCommandButton(ilSrPluginGeneratorConfigGUI::CMD_UPDATE_CONFIGURE, $this->txt("save"));
    }


    /**
     * @inheritDoc
     */
    protected function initFields()/*: void*/
    {
        $this->fields = [
            self::KEY_ROLES => [
                self::PROPERTY_CLASS    => ilMultiSelectInputGUI::class,
                self::PROPERTY_REQUIRED => true,
                self::PROPERTY_OPTIONS  => self::srPluginGenerator()->ilias()->roles()->getAllRoles(),
                "enableSelectAll"       => true
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
        $this->setTitle($this->txt("configuration"));
    }


    /**
     * @inheritDoc
     */
    protected function storeValue(/*string*/ $key, $value)/*: void*/
    {
        switch ($key) {
            case self::KEY_ROLES:
                if ($value[0] === "") {
                    array_shift($value);
                }

                $value = array_map(function (string $role_id) : int {
                    return intval($role_id);
                }, $value);

                self::srPluginGenerator()->config()->setField($key, $value);
                break;

            default:
                self::srPluginGenerator()->config()->setField($key, $value);
                break;
        }
    }
}
