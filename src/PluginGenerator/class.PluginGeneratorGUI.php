<?php

namespace srag\Plugins\SrPluginGenerator\PluginGenerator;

use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class PluginGeneratorGUI
 *
 * @package           srag\Plugins\SrPluginGenerator\PluginGenerator
 *
 * @author            studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 *
 * @ilCtrl_isCalledBy srag\Plugins\SrPluginGenerator\PluginGenerator\PluginGeneratorGUI: ilUIPluginRouterGUI
 */
class PluginGeneratorGUI
{

    use DICTrait;
    use SrPluginGeneratorTrait;
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const CMD_GENERATE = "generate";
    const CMD_GENERATE_FORM = "generateForm";
    const LANG_MODULE = "plugin_generator";
    /**
     * @var Options
     */
    protected $options;


    /**
     * PluginGeneratorGUI constructor
     */
    public function __construct()
    {

    }


    /**
     *
     */
    public function executeCommand()/*: void*/
    {
        $this->options = self::srPluginGenerator()->pluginGenerator()->factory()->newOptionsInstance();

        if (!self::SrPluginGenerator()->currentUserHasRole()) {
            die();
        }

        $this->setTabs();

        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_GENERATE:
                    case self::CMD_GENERATE_FORM:
                        $this->{$cmd}();
                        break;

                    default:
                        break;
                }
                break;
        }
    }


    /**
     *
     */
    protected function setTabs()/*: void*/
    {

    }


    /**
     *
     */
    protected function generateForm()/*: void*/
    {
        $form = self::srPluginGenerator()->pluginGenerator()->factory()->newFormInstance($this, $this->options);

        self::output()->output($form, true);
    }


    /**
     *
     */
    protected function generate()/*: void*/
    {
        $form = self::srPluginGenerator()->pluginGenerator()->factory()->newFormInstance($this, $this->options);

        if (!$form->storeForm()) {
            self::output()->output($form, true);

            return;
        }

        $generator = self::srPluginGenerator()->pluginGenerator()->factory()->newGeneratorInstance($this->options);

        $generator->generate();
    }
}
