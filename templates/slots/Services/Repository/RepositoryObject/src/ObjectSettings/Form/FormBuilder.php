<?php

namespace __NAMESPACE__\ObjectSettings\Form;

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use il__PLUGIN_NAME__Plugin;
use ilObj__PLUGIN_NAME__;
use ilObj__PLUGIN_NAME__GUI;
use srag\CustomInputGUIs\__PLUGIN_NAME__\FormBuilder\AbstractFormBuilder;

/**
 * Class FormBuilder
 *
 * @package __NAMESPACE__\ObjectSettings\Form
 *
 * __AUTHOR_COMMENT__
 */
class FormBuilder extends AbstractFormBuilder
{

    use __PLUGIN_NAME__Trait;

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    /**
     * @var ilObj__PLUGIN_NAME__
     */
    protected $object;


    /**
     * @inheritDoc
     *
     * @param ilObj__PLUGIN_NAME__GUI $parent
     * @param ilObj__PLUGIN_NAME__    $object
     */
    public function __construct(ilObj__PLUGIN_NAME__GUI $parent, ilObj__PLUGIN_NAME__ $object)
    {
        $this->object = $object;

        parent::__construct($parent);
    }


    /**
     * @inheritDoc
     */
    protected function getButtons() : array
    {
        $buttons = [
            ilObj__PLUGIN_NAME__GUI::CMD_SETTINGS_STORE  => self::plugin()->translate("save", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS),
            ilObj__PLUGIN_NAME__GUI::CMD_MANAGE_CONTENTS => self::plugin()->translate("cancel", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS)
        ];

        return $buttons;
    }


    /**
     * @inheritDoc
     */
    protected function getData() : array
    {
        $data = [
            "title"       => $this->object->getTitle(),
            "description" => $this->object->getLongDescription(),
            "online"      => $this->object->isOnline()
        ];

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            "title"       => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("title", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS))->withRequired(true),
            "description" => self::dic()->ui()->factory()->input()->field()->textarea(self::plugin()->translate("description", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS)),
            "online"      => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()->translate("online", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS))
        ];

        return $fields;
    }


    /**
     * @inheritDoc
     */
    protected function getTitle() : string
    {
        return self::plugin()->translate("settings", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_SETTINGS);
    }


    /**
     * @inheritDoc
     */
    protected function storeData(array $data) : void
    {
        $this->object->setTitle(strval($data["title"]));
        $this->object->setDescription(strval($data["description"]));
        $this->object->setOnline(boolval($data["online"]));

        $this->object->update();
    }
}
