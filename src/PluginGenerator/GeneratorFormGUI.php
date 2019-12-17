<?php

namespace srag\Plugins\SrPluginGenerator\PluginGenerator;

use ilEMailInputGUI;
use ilSelectInputGUI;
use ilSrPluginGeneratorPlugin;
use ilTextInputGUI;
use ilUtil;
use srag\CustomInputGUIs\SrPluginGenerator\PropertyFormGUI\ObjectPropertyFormGUI;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class GeneratorFormGUI
 *
 * @package srag\Plugins\SrPluginGenerator\PluginGenerator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class GeneratorFormGUI extends ObjectPropertyFormGUI
{

    use SrPluginGeneratorTrait;
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const LANG_MODULE = PluginGeneratorGUI::LANG_MODULE;


    /**
     * GeneratorFormGUI constructor
     *
     * @param PluginGeneratorGUI $parent
     * @param Options            $object
     */
    public function __construct(PluginGeneratorGUI $parent, Options $object)
    {
        parent::__construct($parent, $object, false);
    }


    /**
     * @inheritDoc
     */
    protected function initCommands()/*: void*/
    {
        $this->addCommandButton(PluginGeneratorGUI::CMD_GENERATE, $this->txt("generate"));
    }


    /**
     * @inheritDoc
     */
    protected function initFields()/*: void*/
    {
        ilUtil::sendInfo(self::output()->getHTML([
            $this->txt("install_steps"),
            self::dic()->ui()->factory()->listing()->ordered([
                nl2br(str_replace("\\n", "\n", self::plugin()->translate("install_steps_1", self::LANG_MODULE, [
                    "xxxx.zip",
                    "~/Downloads"
                ])), false),
                nl2br(str_replace("\\n", "\n", $this->txt("install_steps_2")) . "\n<code>" . implode("\n", [
                        "mkdir -p Customizing/global/plugins",
                        "cd Customizing/global/plugins",
                        "mv ~/Downloads/xxxx.zip xxxx.zip",
                        "unzip xxxx.zip",
                        "unlink xxxx.zip"
                    ]) . "</code>", false),
                str_replace("\\n", "\n", $this->txt("install_steps_3")),
                nl2br(str_replace("\\n", "\n", self::plugin()->translate("install_steps_4", self::LANG_MODULE, [
                    "TODO"
                ])), false)
            ])
        ]));

        $this->fields = [
            "plugin_id"         => [
                self::PROPERTY_CLASS    => ilTextInputGUI::class,
                self::PROPERTY_REQUIRED => true,
                "setValidationRegexp"   => "/^[a-z]{1}[a-z0-9]+$/"
            ],
            "project_key"       => [
                self::PROPERTY_CLASS => ilTextInputGUI::class
            ],
            "plugin_name"       => [
                self::PROPERTY_CLASS    => ilTextInputGUI::class,
                self::PROPERTY_REQUIRED => true,
                "setValidationRegexp"   => "/^[A-Z]{1}[A-Za-z0-9]+$/"
            ],
            "plugin_slot"       => [
                self::PROPERTY_CLASS    => ilSelectInputGUI::class,
                self::PROPERTY_REQUIRED => true,
                self::PROPERTY_OPTIONS  => ["" => ""] + self::srPluginGenerator()->pluginGenerator()->slots()->getSlots()
            ],
            "namespace"         => [
                self::PROPERTY_CLASS    => ilTextInputGUI::class,
                self::PROPERTY_REQUIRED => true,
                "setValidationRegexp"   => "/^([A-Za-z(__PLUGIN_NAME__)]+\\\\)+$/"
            ],
            "responsible_name"  => [
                self::PROPERTY_CLASS    => ilTextInputGUI::class,
                self::PROPERTY_REQUIRED => true
            ],
            "responsible_email" => [
                self::PROPERTY_CLASS    => ilEMailInputGUI::class,
                self::PROPERTY_REQUIRED => true
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
        $this->setTitle($this->txt("title"));
    }


    /**
     * @inheritDoc
     */
    public function storeForm() : bool
    {
        if (!$this->storeFormCheck()) {
            return false;
        }

        if ($this->getInput("plugin_slot") === Slots::REPOSITORY_OBJECT) {
            $plugin_id = $this->getInput("plugin_id");

            if ($plugin_id[0] !== "x" || strlen($plugin_id) !== 4) {
                $this->getItemByPostVar("plugin_id")->setAlert(self::dic()->language()->txt("msg_wrong_format"));

                return false;
            }
        }

        return parent::storeForm();
    }
}
