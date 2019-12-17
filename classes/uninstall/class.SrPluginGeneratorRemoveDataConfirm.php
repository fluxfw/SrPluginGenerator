<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;
use srag\RemovePluginDataConfirm\SrPluginGenerator\AbstractRemovePluginDataConfirm;

/**
 * Class SrPluginGeneratorRemoveDataConfirm
 *
 * @author            studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 *
 * @ilCtrl_isCalledBy SrPluginGeneratorRemoveDataConfirm: ilUIPluginRouterGUI
 */
class SrPluginGeneratorRemoveDataConfirm extends AbstractRemovePluginDataConfirm
{

    use SrPluginGeneratorTrait;
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
}
