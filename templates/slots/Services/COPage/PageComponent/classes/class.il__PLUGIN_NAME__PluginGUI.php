<?php

use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class il__PLUGIN_NAME__PluginGUI__VERSION_COMMENT__
 *
 * @author            studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author            __RESPONSIBLE_NAME__ <__RESPONSIBLE_EMAIL__>
 *
 * @ilCtrl_isCalledBy il__PLUGIN_NAME__PluginGUI: ilPCPluggedGUI
 */
class il__PLUGIN_NAME__PluginGUI extends ilPageComponentPluginGUI
{

    use DICTrait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const CMD_CANCEL = "cancel";
    const CMD_CREATE = "create";
    const CMD_CREATE_PLUG = "create_plug";
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
     *
     */
    public function executeCommand()
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
     *
     */
    public function insert()
    {
        $this->edit();
    }


    /**
     *
     */
    public function create()
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
     *
     */
    public function edit()
    {
        $form = $this->getForm();

        self::output()->output($form);
    }


    /**
     *
     */
    public function update()
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
    public function cancel()
    {
        $this->returnToParent();
    }


    /**
     * @param string $a_mode
     * @param array  $a_properties
     * @param string $plugin_version
     *
     * @return string
     */
    public function getElementHTML($a_mode, array $a_properties, $plugin_version) : string
    {
        return ""; // TODO: Implement getElementHTML
    }
}
