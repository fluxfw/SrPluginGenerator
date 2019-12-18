<?php

use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Generator\PluginGeneratorGUI;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class ilSrPluginGeneratorUIHookGUI
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilSrPluginGeneratorUIHookGUI extends ilUIHookPluginGUI
{

    use DICTrait;
    use SrPluginGeneratorTrait;
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;


    /**
     * ilSrPluginGeneratorUIHookGUI constructor
     */
    public function __construct()
    {

    }


    /**
     *
     */
    public function gotoHook()/*: void*/
    {
        $target = filter_input(INPUT_GET, "target");

        $matches = [];
        preg_match("/^uihk_" . ilSrPluginGeneratorPlugin::PLUGIN_ID . "(_(.*))?/uim", $target, $matches);

        if (is_array($matches) && count($matches) >= 1) {

            self::dic()->ctrl()->setTargetScript("ilias.php"); // Fix ILIAS 5.3 bug
            self::dic()->ctrl()->initBaseClass(ilUIPluginRouterGUI::class); // Fix ILIAS bug

            self::dic()->ctrl()->redirectByClass([ilUIPluginRouterGUI::class, PluginGeneratorGUI::class], PluginGeneratorGUI::CMD_FILL);
        }
    }
}
