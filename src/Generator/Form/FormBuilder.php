<?php

namespace srag\Plugins\SrPluginGenerator\Generator\Form;

use Closure;
use ilCheckboxInputGUI;
use ILIAS\UI\Component\Input\Field\Radio;
use ILIAS\UI\Implementation\Component\Input\Field\Group;
use ilSrPluginGeneratorPlugin;
use srag\CustomInputGUIs\SrPluginGenerator\FormBuilder\AbstractFormBuilder;
use srag\CustomInputGUIs\SrPluginGenerator\InputGUIWrapperUIInputComponent\InputGUIWrapperUIInputComponent;
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
            if ($key === "features") {
                $data[$key] = [];
                foreach (array_keys($this->getFields()[$key]->getInputs()) as $key2) {
                    if ($key2 !== "enable_php72backport_script") {
                        $data[$key][$key2] = Items::getter($this->options, $key2);
                    }
                }
            } else {
                $data[$key] = Items::getter($this->options, $key);
            }
        }

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            "plugin_id"           => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("plugin_id", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("plugin_id_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "project_key"         => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("project_key", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("project_key_info", PluginGeneratorGUI::LANG_MODULE)),
            "plugin_name"         => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("plugin_name", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("plugin_name_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "plugin_slot"         => self::dic()->ui()->factory()->input()->field()->select(self::plugin()->translate("plugin_slot", PluginGeneratorGUI::LANG_MODULE),
                ["" => ""] + self::srPluginGenerator()->generator()->slots()->getSlots())->withRequired(true),
            "init_plugin_version" => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("init_plugin_version", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("init_plugin_version_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "min_ilias_version"   => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("min_ilias_version", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("min_ilias_version_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "max_ilias_version"   => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("max_ilias_version", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("max_ilias_version_info", PluginGeneratorGUI::LANG_MODULE))->withRequired(true),
            "min_php_version"     => array_reduce(array_keys(Options::PHP_VERSIONS), function (Radio $radio, string $php_version) : Radio {
                $radio = $radio->withOption($php_version, Options::PHP_VERSIONS[$php_version], ($php_version === Options::DEFAULT_MIN_PHP_VERSION ? self::plugin()
                    ->translate("min_php_version_70_info", PluginGeneratorGUI::LANG_MODULE, ["Composer", "PHP72Backport"]) : null));

                return $radio;
            }, self::dic()->ui()->factory()->input()->field()->radio(self::plugin()
                ->translate("min_php_version", PluginGeneratorGUI::LANG_MODULE))->withRequired(true)),
            "namespace"           => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("namespace", PluginGeneratorGUI::LANG_MODULE),
                self::plugin()->translate("namespace_info", PluginGeneratorGUI::LANG_MODULE, ["__PLUGIN_NAME__"]))->withRequired(true),
            "responsible_name"    => self::dic()
                ->ui()
                ->factory()
                ->input()
                ->field()
                ->text(self::plugin()->translate("responsible_name", PluginGeneratorGUI::LANG_MODULE))
                ->withRequired(true),
            "responsible_email"   => self::dic()
                ->ui()
                ->factory()
                ->input()
                ->field()
                ->text(self::plugin()->translate("responsible_email", PluginGeneratorGUI::LANG_MODULE))
                ->withRequired(true),
            "features"            => self::dic()->ui()->factory()->input()->field()->section([
                "enable_dev_tools"                              => self::dic()
                    ->ui()
                    ->factory()
                    ->input()
                    ->field()
                    ->checkbox(self::plugin()->translate("enable_dev_tools", PluginGeneratorGUI::LANG_MODULE))
                    ->withByline(nl2br(self::plugin()->translate("enable_dev_tools_info", PluginGeneratorGUI::LANG_MODULE), false)),
                "enable_librariesnamespacechanger_script"       => (self::version()->is6()
                    ? self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                        ->translate("enable_librariesnamespacechanger_script", PluginGeneratorGUI::LANG_MODULE, ["Composer", "LibrariesNamespaceChanger"]))
                    : new InputGUIWrapperUIInputComponent(new ilCheckboxInputGUI(self::plugin()
                        ->translate("enable_librariesnamespacechanger_script", PluginGeneratorGUI::LANG_MODULE, ["Composer", "LibrariesNamespaceChanger"]))))->withByline(nl2br(self::plugin()
                    ->translate("enable_librariesnamespacechanger_script_info", PluginGeneratorGUI::LANG_MODULE), false))->withRequired(true)->withDisabled(true),
                "enable_php72backport_script"                   => (self::version()->is6()
                    ? self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                        ->translate("enable_php72backport_script", PluginGeneratorGUI::LANG_MODULE, ["Composer", "PHP72Backport"]))
                    : new InputGUIWrapperUIInputComponent(new ilCheckboxInputGUI(self::plugin()
                        ->translate("enable_php72backport_script", PluginGeneratorGUI::LANG_MODULE, ["Composer", "PHP72Backport"]))))->withByline(self::plugin()
                    ->translate("enable_php72backport_script_info", PluginGeneratorGUI::LANG_MODULE))->withDisabled(true),
                "enable_min_php_version_checker"                => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                    ->translate("enable_min_php_version_checker", PluginGeneratorGUI::LANG_MODULE), self::plugin()
                    ->translate("enable_min_php_version_checker_info", PluginGeneratorGUI::LANG_MODULE)),
                "enable_should_use_one_update_step_only"        => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                    ->translate("enable_should_use_one_update_step_only", PluginGeneratorGUI::LANG_MODULE), self::plugin()
                    ->translate("enable_should_use_one_update_step_only_info", PluginGeneratorGUI::LANG_MODULE)),
                "enable_autogenerate_plugin_php_and_xml_script" => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                    ->translate("enable_autogenerate_plugin_php_and_xml_script", PluginGeneratorGUI::LANG_MODULE, ["Composer", "plugin.php", "plugin.xml", "composer.json"])),
                "enable_autogenerate_plugin_readme_script"      => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                    ->translate("enable_autogenerate_plugin_readme_script", PluginGeneratorGUI::LANG_MODULE, ["Composer", "README.md", "composer.json"]))
            ], self::plugin()->translate("features", PluginGeneratorGUI::LANG_MODULE), nl2br(self::plugin()->translate("features_info", PluginGeneratorGUI::LANG_MODULE), false))
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
    protected function storeData(array $data) : void
    {
        foreach (array_keys($this->getFields()) as $key) {
            if ($key === "features") {
                foreach (array_keys($this->getFields()[$key]->getInputs()) as $key2) {
                    if (!in_array($key2, ["enable_librariesnamespacechanger_script", "enable_php72backport_script"])) {
                        Items::setter($this->options, $key2, $data[$key][$key2]);
                    }
                }
            } else {
                Items::setter($this->options, $key, $data[$key]);
            }
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

        foreach (["init_plugin_version", "min_ilias_version", "max_ilias_version"] as $key) {
            if (!preg_match("/^[0-9]+(\.[0-9]+)+$/", strval($data[$key]))) {
                $inputs[$key] = $inputs[$key]->withError(self::dic()->language()->txt("msg_wrong_format"));

                $ok = false;
            }
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

        Closure::bind(function (array $inputs) : void {
            $this->inputs = $inputs;
        }, $this->form->getInputs()["form"], Group::class)($inputs);

        return $ok;
    }
}
