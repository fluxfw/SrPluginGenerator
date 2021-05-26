<?php

namespace srag\ActiveRecordConfig\SrPluginGenerator;

use srag\CustomInputGUIs\SrPluginGenerator\PropertyFormGUI\ConfigPropertyFormGUI;

/**
 * Class ActiveRecordConfigFormGUI
 *
 * @package    srag\ActiveRecordConfig\SrPluginGenerator
 *
 * @deprecated Please use PropertyFormGUI from CustomInputGUIs instead
 */
abstract class ActiveRecordConfigFormGUI extends ConfigPropertyFormGUI
{

    /**
     * @var string
     *
     * @deprecated
     */
    const LANG_MODULE = ActiveRecordConfigGUI::LANG_MODULE_CONFIG;
    /**
     * @var string
     *
     * @deprecated
     */
    protected $tab_id;


    /**
     * ActiveRecordConfigFormGUI constructor
     *
     * @param ActiveRecordConfigGUI $parent
     * @param string                $tab_id
     *
     * @deprecated
     */
    public function __construct(ActiveRecordConfigGUI $parent, string $tab_id)
    {
        $this->tab_id = $tab_id;

        parent::__construct($parent);
    }


    /**
     * @inheritDoc
     *
     * @deprecated
     */
    protected function initCommands()/*: void*/
    {
        $this->addCommandButton(ActiveRecordConfigGUI::CMD_UPDATE_CONFIGURE . "_" . $this->tab_id, $this->txt("save"));
    }


    /**
     * @inheritDoc
     *
     * @deprecated
     */
    protected function initId()/*: void*/
    {

    }


    /**
     * @inheritDoc
     *
     * @deprecated
     */
    protected function initTitle()/*: void*/
    {
        $this->setTitle($this->txt($this->tab_id));
    }
}
