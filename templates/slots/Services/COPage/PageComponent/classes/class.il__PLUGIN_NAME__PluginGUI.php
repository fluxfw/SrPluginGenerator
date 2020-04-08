<?php

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class il__PLUGIN_NAME__PluginGUI__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 *
 * @ilCtrl_isCalledBy il__PLUGIN_NAME__PluginGUI: ilPCPluggedGUI
 */
class il__PLUGIN_NAME__PluginGUI extends ilPageComponentPluginGUI
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const CMD_CANCEL = "cancel";
    const CMD_CREATE = "create";
    const CMD_EDIT = "edit";
    const CMD_INSERT = "insert";
    const CMD_UPDATE = "update";


    /**
     * il__PLUGIN_NAME__PluginGUI constructor
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @inheritDoc
     */
    public function executeCommand() : void
    {
        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_CANCEL:
                    case self::CMD_CREATE:
                    case self::CMD_EDIT:
                    case self::CMD_INSERT:
                    case self::CMD_UPDATE:
                        $this->{$cmd}();
                        break;

                    default:
                        break;
                }
                break;
        }
    }


    /**
     * @return ilPropertyFormGUI
     */
    protected function getForm() : ilPropertyFormGUI
    {
        $form = new ilPropertyFormGUI();

        // TODO: Implement getForm
        // TODO: Use seperate class

        return $form;
    }


    /**
     * @inheritDoc
     */
    public function insert() : void
    {
        $this->edit();
    }


    /**
     * @inheritDoc
     */
    public function create() : void
    {
        $form = $this->getForm();

        $form->setValuesByPost();

        if (!$form->checkInput()) {
            self::output()->output($form);

            return;
        }

        // TODO: Implement create

        $properties = [

        ];
        $this->createElement($properties);

        $this->returnToParent();
    }


    /**
     * @inheritDoc
     */
    public function edit() : void
    {
        $form = $this->getForm();

        self::output()->output($form);
    }


    /**
     *
     */
    public function update() : void
    {
        $form = $this->getForm();

        $form->setValuesByPost();

        if (!$form->checkInput()) {
            self::output()->output($form);

            return;
        }

        $properties = $this->getProperties();

        // TODO: Implement update

        $this->updateElement($properties);

        $this->returnToParent();
    }


    /**
     *
     */
    public function cancel() : void
    {
        $this->returnToParent();
    }


    /**
     * @inheritDoc
     */
    public function getElementHTML(/*string*/ $a_mode, array $a_properties, /*string*/ $plugin_version) : string
    {
        return ""; // TODO: Implement getElementHTML
    }
}
