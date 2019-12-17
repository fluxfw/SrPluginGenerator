<?php

use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class il__PLUGIN_NAME__UIHookGUI__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class il__PLUGIN_NAME__UIHookGUI extends ilUIHookPluginGUI
{

    use DICTrait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;


    /**
     * il__PLUGIN_NAME__UIHookGUI constructor
     */
    public function __construct()
    {

    }


    /**
     * @param string $a_comp
     * @param string $a_part
     * @param array  $a_par
     *
     * @return array
     */
    public function getHTML(/*string*/
        $a_comp, /*string*/
        $a_part, /*array*/
        $a_par = []
    ) : array {
        /*self::dic()->ctrl()->getLinkTargetByClass([
            ilUIPluginRouterGUI::class,
            GUI::class
        ], GUI::CMD_SOME);*/

        // TODO: Implement getHTML

        return ["mode" => self::KEEP, "html" => ""];
    }
}
