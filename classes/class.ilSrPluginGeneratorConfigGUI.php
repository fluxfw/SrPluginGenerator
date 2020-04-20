<?php

require_once __DIR__ . "/../vendor/autoload.php";

use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Config\ConfigCtrl;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class ilSrPluginGeneratorConfigGUI
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilSrPluginGeneratorConfigGUI extends ilPluginConfigGUI
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const CMD_CONFIGURE = "configure";


    /**
     * ilSrPluginGeneratorConfigGUI constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function performCommand(/*string*/ $cmd)/*:void*/
    {
        $this->setTabs();

        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            case strtolower(ConfigCtrl::class):
                self::dic()->ctrl()->forwardCommand(new ConfigCtrl());
                break;

            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_CONFIGURE:
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
        ConfigCtrl::addTabs();

        self::dic()->locator()->addItem(ilSrPluginGeneratorPlugin::PLUGIN_NAME, self::dic()->ctrl()->getLinkTarget($this, self::CMD_CONFIGURE));
    }


    /**
     *
     */
    protected function configure()/*: void*/
    {
        self::dic()->ctrl()->redirectByClass(ConfigCtrl::class, ConfigCtrl::CMD_CONFIGURE);
    }
}
