<?php

namespace srag\Plugins\SrPluginGenerator\Config;

use ilMultiSelectInputGUI;
use ilSrPluginGeneratorConfigGUI;
use ilSrPluginGeneratorPlugin;
use srag\CustomInputGUIs\SrPluginGenerator\PropertyFormGUI\ConfigPropertyFormGUI;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class ConfigFormGUI
 *
 * @package srag\Plugins\SrPluginGenerator\Config
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ConfigFormGUI extends ConfigPropertyFormGUI
{

    use SrPluginGeneratorTrait;
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const CONFIG_CLASS_NAME = Config::class;
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
     * @inheritdoc
     */
    protected function getValue(/*string*/ $key)
    {
        switch ($key) {
            default:
                return parent::getValue($key);
        }
    }


    /**
     * @inheritdoc
     */
    protected function initCommands()/*: void*/
    {
        $this->addCommandButton(ilSrPluginGeneratorConfigGUI::CMD_UPDATE_CONFIGURE, $this->txt("save"));
    }


    /**
     * @inheritdoc
     */
    protected function initFields()/*: void*/
    {
        $this->fields = [
            Config::KEY_ROLES      => [
                self::PROPERTY_CLASS    => ilMultiSelectInputGUI::class,
                self::PROPERTY_REQUIRED => true,
                self::PROPERTY_OPTIONS  => self::srPluginGenerator()->ilias()->roles()->getAllRoles(),
                "enableSelectAll"       => true
            ],
            Config::KEY_ROLES_MENU => [
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
     * @inheritdoc
     */
    protected function initTitle()/*: void*/
    {
        $this->setTitle($this->txt("configuration"));
    }


    /**
     * @inheritdoc
     */
    protected function storeValue(/*string*/ $key, $value)/*: void*/
    {
        switch ($key) {
            case Config::KEY_ROLES:
            case Config::KEY_ROLES_MENU:
                if ($value[0] === "") {
                    array_shift($value);
                }

                $value = array_map(function (string $role_id) : int {
                    return intval($role_id);
                }, $value);
                break;

            default:
                break;
        }

        parent::storeValue($key, $value);
    }
}
