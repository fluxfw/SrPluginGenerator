<?php

namespace __NAMESPACE__\GUI;

use il__PLUGIN_NAME__Plugin;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class GUI__VERSION_COMMENT__
 *
 * @package           __NAMESPACE__\GUI
 *
 * __AUTHOR_COMMENT__
 *
 * @ilCtrl_isCalledBy __NAMESPACE__\GUI\GUI: ilUIPluginRouterGUI
 */
class GUI
{

    use DICTrait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const CMD_SOME = "some";


    /**
     * GUI constructor
     */
    public function __construct()
    {

    }


    /**
     *
     */
    public function executeCommand()/*: void*/
    {
        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_SOME:
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
    protected function some()/*: void*/
    {
        self::output()->output("some", true);
    }
}
