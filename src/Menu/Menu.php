<?php

namespace srag\Plugins\SrPluginGenerator\Menu;

use ILIAS\GlobalScreen\Scope\MainMenu\Provider\AbstractStaticMainMenuPluginProvider;
use ILIAS\UI\Component\Symbol\Icon\Standard;
use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Generator\PluginGeneratorGUI;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Menu
 *
 * @package srag\Plugins\SrPluginGenerator\Menu
 */
class Menu extends AbstractStaticMainMenuPluginProvider
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;


    /**
     * @inheritDoc
     */
    public function getStaticSubItems() : array
    {
        return [];
    }


    /**
     * @inheritDoc
     */
    public function getStaticTopItems() : array
    {
        return [
            $this->mainmenu->topLinkItem($this->if->identifier(ilSrPluginGeneratorPlugin::PLUGIN_ID))
                ->withTitle(self::plugin()->translate("title", PluginGeneratorGUI::LANG_MODULE))
                ->withAction(self::srPluginGenerator()->generator()->getLink())
                ->withSymbol(self::dic()->ui()->factory()->symbol()->icon()->standard(Standard::CMPS, ilSrPluginGeneratorPlugin::PLUGIN_NAME)->withIsOutlined(true))
                ->withAvailableCallable(function () : bool {
                    return self::plugin()->getPluginObject()->isActive();
                })
                ->withVisibilityCallable(function () : bool {
                    return self::srPluginGenerator()->currentUserHasRole();
                })
        ];
    }
}
