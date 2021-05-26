<?php

namespace srag\Plugins\SrPluginGenerator\Config\Form;

use ilSrPluginGeneratorPlugin;
use srag\CustomInputGUIs\SrPluginGenerator\FormBuilder\AbstractFormBuilder;
use srag\CustomInputGUIs\SrPluginGenerator\InputGUIWrapperUIInputComponent\InputGUIWrapperUIInputComponent;
use srag\CustomInputGUIs\SrPluginGenerator\MultiSelectSearchNewInputGUI\MultiSelectSearchNewInputGUI;
use srag\Plugins\SrPluginGenerator\Config\ConfigCtrl;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class FormBuilder
 *
 * @package srag\Plugins\SrPluginGenerator\Config\Form
 */
class FormBuilder extends AbstractFormBuilder
{

    use SrPluginGeneratorTrait;

    const KEY_ROLES = "roles";
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;


    /**
     * @inheritDoc
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
    protected function getButtons() : array
    {
        $buttons = [
            ConfigCtrl::CMD_UPDATE_CONFIGURE => self::plugin()->translate("save", ConfigCtrl::LANG_MODULE)
        ];

        return $buttons;
    }


    /**
     * @inheritDoc
     */
    protected function getData() : array
    {
        $data = [
            self::KEY_ROLES => self::srPluginGenerator()->config()->getValue(self::KEY_ROLES)
        ];

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            self::KEY_ROLES => (new InputGUIWrapperUIInputComponent(new MultiSelectSearchNewInputGUI(self::plugin()
                ->translate(self::KEY_ROLES, ConfigCtrl::LANG_MODULE))))->withByline(self::plugin()
                ->translate(self::KEY_ROLES . "_info", ConfigCtrl::LANG_MODULE))->withRequired(true)
        ];
        $fields[self::KEY_ROLES]->getInput()->setOptions(self::srPluginGenerator()->ilias()->roles()->getAllRoles());

        return $fields;
    }


    /**
     * @inheritDoc
     */
    protected function getTitle() : string
    {
        return self::plugin()->translate("configuration", ConfigCtrl::LANG_MODULE);
    }


    /**
     * @inheritDoc
     */
    protected function storeData(array $data) : void
    {
        self::srPluginGenerator()->config()->setValue(self::KEY_ROLES, MultiSelectSearchNewInputGUI::cleanValues((array) $data[self::KEY_ROLES]));
    }
}
