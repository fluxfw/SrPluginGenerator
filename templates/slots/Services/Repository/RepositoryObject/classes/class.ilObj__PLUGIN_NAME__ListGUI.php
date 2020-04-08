<?php

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class ilObj__PLUGIN_NAME__ListGUI__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 */
class ilObj__PLUGIN_NAME__ListGUI extends ilObjectPluginListGUI
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;


    /**
     * ilObj__PLUGIN_NAME__ListGUI constructor
     *
     * @param int $a_context
     */
    public function __construct(int $a_context = self::CONTEXT_REPOSITORY)
    {
        parent::__construct($a_context);
    }


    /**
     * @inheritDoc
     */
    public function getGuiClass() : string
    {
        return ilObj__PLUGIN_NAME__GUI::class;
    }


    /**
     * @inheritDoc
     */
    public function initCommands() : array
    {
        $this->commands_enabled = true;
        $this->copy_enabled = true;
        $this->cut_enabled = true;
        $this->delete_enabled = true;
        $this->description_enabled = true;
        $this->notice_properties_enabled = true;
        $this->properties_enabled = true;

        $this->comments_enabled = false;
        $this->comments_settings_enabled = false;
        $this->expand_enabled = false;
        $this->info_screen_enabled = false;
        $this->link_enabled = false;
        $this->notes_enabled = false;
        $this->payment_enabled = false;
        $this->preconditions_enabled = false;
        $this->rating_enabled = false;
        $this->rating_categories_enabled = false;
        $this->repository_transfer_enabled = false;
        $this->search_fragment_enabled = false;
        $this->static_link_enabled = false;
        $this->subscribe_enabled = false;
        $this->tags_enabled = false;
        $this->timings_enabled = false;

        $commands = [
            [
                "permission" => "read",
                "cmd"        => ilObj__PLUGIN_NAME__GUI::getStartCmd(),
                "default"    => true
            ]
        ];

        return $commands;
    }


    /**
     * @inheritDoc
     */
    public function getProperties() : array
    {
        $props = [];

        if (ilObj__PLUGIN_NAME__Access::_isOffline($this->obj_id)) {
            $props[] = [
                "alert"    => true,
                "property" => self::plugin()->translate("status", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_OBJECT),
                "value"    => self::plugin()->translate("offline", ilObj__PLUGIN_NAME__GUI::LANG_MODULE_OBJECT)
            ];
        }

        return $props;
    }


    /**
     * @inheritDoc
     */
    public function initType() : void
    {
        $this->setType(il__PLUGIN_NAME__Plugin::PLUGIN_ID);
    }
}
