<?php

namespace __NAMESPACE__\Config\Form;

use __NAMESPACE__\Config\ConfigCtrl;
use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use il__PLUGIN_NAME__Plugin;
use srag\CustomInputGUIs\__PLUGIN_NAME__\FormBuilder\AbstractFormBuilder;

/**
 * Class FormBuilder
 *
 * @package __NAMESPACE__\Config\Form
 *
 * __AUTHOR_COMMENT__
 */
class FormBuilder extends AbstractFormBuilder
{

    use __PLUGIN_NAME__Trait;

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const KEY_SOME = "some";


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
            self::KEY_SOME => self::__PLUGIN_NAME_CAMEL_CASE__()->config()->getValue(self::KEY_SOME)
        ];

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            self::KEY_SOME => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate(self::KEY_SOME, ConfigCtrl::LANG_MODULE))->withRequired(true)
        ];

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
        self::__PLUGIN_NAME_CAMEL_CASE__()->config()->setValue(self::KEY_SOME, strval($data[self::KEY_SOME]));
    }
}
