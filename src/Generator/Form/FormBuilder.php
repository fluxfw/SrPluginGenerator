<?php

namespace srag\Plugins\SrPluginGenerator\Generator\Form;

use Closure;
use ILIAS\UI\Implementation\Component\Input\Field\Group;
use ilSrPluginGeneratorPlugin;
use srag\CustomInputGUIs\SrPluginGenerator\FormBuilder\AbstractFormBuilder;
use srag\CustomInputGUIs\SrPluginGenerator\PropertyFormGUI\Items\Items;
use srag\Plugins\SrPluginGenerator\Generator\Options;
use srag\Plugins\SrPluginGenerator\Generator\PluginGeneratorGUI;
use srag\Plugins\SrPluginGenerator\Generator\Slots;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class FormBuilder
 *
 * @package srag\Plugins\SrPluginGenerator\Generator\Form
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class FormBuilder extends AbstractFormBuilder
{

    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    /**
     * @var Options
     */
    protected $options;


    /**
     * @inheritDoc
     *
     * @param PluginGeneratorGUI $parent
     * @param Options            $options
     */
    public function __construct(PluginGeneratorGUI $parent, Options $options)
    {
        $this->options = $options;

        parent::__construct($parent);
    }


    /**
     * @inheritDoc
     */
    protected function getButtons() : array
    {
        $buttons = [
            PluginGeneratorGUI::CMD_GENERATE => self::plugin()->translate("generate", PluginGeneratorGUI::LANG_MODULE)
        ];

        return $buttons;
    }


    /**
     * @inheritDoc
     */
    protected function getData() : array
    {
        $data = [];

        foreach (array_keys($this->getFields()) as $key) {
            $data[$key] = Items::getter($this->options, $key);
        }

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            "plugin_id"         => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("plugin_id", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("plugin_id_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "project_key"       => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("project_key", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("project_key_info", PluginGeneratorGUI::LANG_MODULE)),
            "plugin_name"       => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("plugin_name", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("plugin_name_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "plugin_slot"       => self::dic()->ui()->factory()->input()->field()->select(self::plugin()->translate("plugin_slot", PluginGeneratorGUI::LANG_MODULE),
                ["" => ""] + self::srPluginGenerator()->generator()->slots()->getSlots())->withRequired(true),
            "namespace"         => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("namespace", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("namespace_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "responsible_name"  => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("responsible_name", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "responsible_email" => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("responsible_email", PluginGeneratorGUI::LANG_MODULE))->withRequired(true)
        ];

        return $fields;
    }


    /**
     * @inheritDoc
     */
    protected function getTitle() : string
    {
        return self::plugin()->translate("title", PluginGeneratorGUI::LANG_MODULE);
    }


    /**
     * @inheritDoc
     */
    public function render() : string
    {
        $this->messages[] = self::dic()->ui()->factory()->messageBox()->info(self::output()->getHTML([
            self::plugin()->translate("install_steps", PluginGeneratorGUI::LANG_MODULE),
            self::dic()->ui()->factory()->listing()->ordered([
                nl2br(self::plugin()->translate("install_steps_1", PluginGeneratorGUI::LANG_MODULE, [
                    "xxxx.zip",
                    "~/Downloads"
                ]), false),
                nl2br(self::plugin()->translate("install_steps_2", PluginGeneratorGUI::LANG_MODULE) . "\n<code>" . implode("\n", [
                        "mkdir -p Customizing/global/plugins",
                        "cd Customizing/global/plugins",
                        "mv ~/Downloads/xxxx.zip xxxx.zip",
                        "unzip xxxx.zip",
                        "unlink xxxx.zip"
                    ]) . "</code>", false),
                self::plugin()->translate("install_steps_3", PluginGeneratorGUI::LANG_MODULE),
                nl2br(self::plugin()->translate("install_steps_4", PluginGeneratorGUI::LANG_MODULE, [
                    "TODO"
                ]), false)
            ])
        ]));

        return parent::render();
    }


    /**
     * @inheritDoc
     */
    protected function storeData(array $data)/* : void*/
    {
        foreach (array_keys($this->getFields()) as $key) {
            Items::setter($this->options, $key, $data[$key]);
        }
    }


    /**
     * @inheritDoc
     */
    protected function validateData(array $data) : bool
    {
        $ok = true;

        $inputs = $this->form->getInputs()["form"]->getInputs();

        if (!preg_match("/^[a-z]{1}[a-z0-9]+$/", strval($data["plugin_id"]))) {
            $inputs["plugin_id"] = $inputs["plugin_id"]->withError(self::dic()->language()->txt("msg_wrong_format"));

            $ok = false;
        }

        if (!preg_match("/^[A-Z]{1}[A-Za-z0-9]+$/", strval($data["plugin_name"]))) {
            $inputs["plugin_name"] = $inputs["plugin_name"]->withError(self::dic()->language()->txt("msg_wrong_format"));

            $ok = false;
        }

        if (!preg_match("/^([A-Za-z(__PLUGIN_NAME__)]+\\\\)+$/", strval($data["namespace"]))) {
            $inputs["namespace"] = $inputs["namespace"]->withError(self::dic()->language()->txt("msg_wrong_format"));

            $ok = false;
        }

        if (!filter_var(strval($data["responsible_email"]), FILTER_VALIDATE_EMAIL)) {
            $inputs["responsible_email"] = $inputs["responsible_email"]->withError(self::dic()->language()->txt("msg_wrong_format"));

            $ok = false;
        }

        if (strval($data["plugin_slot"]) === Slots::REPOSITORY_OBJECT) {
            if (strval($data["plugin_id"])[0] !== "x" || strlen(strval($data["plugin_id"])) !== 4) {

                $inputs["plugin_id"] = $inputs["plugin_id"]->withError(self::dic()->language()->txt("msg_wrong_format"));

                $ok = false;
            }
        }

        Closure::bind(function (array $inputs)/* : void*/ {
            $this->inputs = $inputs;
        }, $this->form->getInputs()["form"], Group::class)($inputs);

        return $ok;
    }
}
