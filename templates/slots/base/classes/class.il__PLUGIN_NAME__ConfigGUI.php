<?php

require_once __DIR__ . "/../vendor/autoload.php";

use __NAMESPACE__\Config\ConfigCtrl;
use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class il__PLUGIN_NAME__ConfigGUI__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class il__PLUGIN_NAME__ConfigGUI extends ilPluginConfigGUI
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const CMD_CONFIGURE = "configure";


    /**
     * il__PLUGIN_NAME__ConfigGUI constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function performCommand(/*string*/ $cmd)/* : void*/
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
    protected function setTabs()/* : void*/
    {
        ConfigCtrl::addTabs();

        self::dic()->locator()->addItem(il__PLUGIN_NAME__Plugin::PLUGIN_NAME, self::dic()->ctrl()->getLinkTarget($this, self::CMD_CONFIGURE));
    }


    /**
     *
     */
    protected function configure()/* : void*/
    {
        self::dic()->ctrl()->redirectByClass(ConfigCtrl::class, ConfigCtrl::CMD_CONFIGURE);
    }
}
