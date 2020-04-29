<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class PluginGeneratorGUI
 *
 * @package           srag\Plugins\SrPluginGenerator\Generator
 *
 * @author            studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 *
 * @ilCtrl_isCalledBy srag\Plugins\SrPluginGenerator\Generator\PluginGeneratorGUI: ilUIPluginRouterGUI
 */
class PluginGeneratorGUI
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const CMD_FILL = "fill";
    const CMD_GENERATE = "generate";
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
        $this->options = self::srPluginGenerator()->generator()->factory()->newOptionsInstance();

        if (!self::srPluginGenerator()->currentUserHasRole()) {
            die();
        }

        $this->setTabs();

        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_FILL:
                    case self::CMD_GENERATE:
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
    protected function fill()/*: void*/
    {
        $form = self::srPluginGenerator()->generator()->factory()->newFormInstance($this, $this->options);

        self::output()->output($form, true);
    }


    /**
     *
     */
    protected function generate()/*: void*/
    {
        $form = self::srPluginGenerator()->generator()->factory()->newFormInstance($this, $this->options);

        if (!$form->storeForm()) {
            self::output()->output($form, true);

            return;
        }

        $generator = self::srPluginGenerator()->generator()->factory()->newGeneratorInstance($this->options);

        $generator->generate();
    }
}
