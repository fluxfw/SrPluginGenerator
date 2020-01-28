<?php

use __NAMESPACE__\ObjectSettings\ObjectSettingsFormGUI;
use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class ilObj__PLUGIN_NAME__GUI__VERSION_COMMENT__
 *
 * __AUTHOR_COMMENT__
 *
 * @ilCtrl_isCalledBy ilObj__PLUGIN_NAME__GUI: ilRepositoryGUI
 * @ilCtrl_isCalledBy ilObj__PLUGIN_NAME__GUI: ilObjPluginDispatchGUI
 * @ilCtrl_isCalledBy ilObj__PLUGIN_NAME__GUI: ilAdministrationGUI
 * @ilCtrl_Calls      ilObj__PLUGIN_NAME__GUI: ilPermissionGUI
 * @ilCtrl_Calls      ilObj__PLUGIN_NAME__GUI: ilInfoScreenGUI
 * @ilCtrl_Calls      ilObj__PLUGIN_NAME__GUI: ilObjectCopyGUI
 * @ilCtrl_Calls      ilObj__PLUGIN_NAME__GUI: ilCommonActionDispatcherGUI
 */
class ilObj__PLUGIN_NAME__GUI extends ilObjectPluginGUI
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    const CMD_MANAGE_CONTENTS = "manageContents";
    const CMD_PERMISSIONS = "perm";
    const CMD_SETTINGS = "settings";
    const CMD_SETTINGS_STORE = "settingsStore";
    const CMD_SHOW_CONTENTS = "showContents";
    const LANG_MODULE_OBJECT = "object";
    const LANG_MODULE_SETTINGS = "settings";
    const TAB_CONTENTS = "contents";
    const TAB_PERMISSIONS = "perm_settings";
    const TAB_SETTINGS = "settings";
    const TAB_SHOW_CONTENTS = "show_contents";
    /**
     * @var ilObj__PLUGIN_NAME__
     */
    public $object;


    /**
     * @inheritDoc
     */
    protected function afterConstructor()/*: void*/
    {

    }


    /**
     * @inheritDoc
     */
    public final function getType() : string
    {
        return il__PLUGIN_NAME__Plugin::PLUGIN_ID;
    }


    /**
     * @param string $cmd
     */
    public function performCommand(string $cmd)/*: void*/
    {
        self::dic()->help()->setScreenIdComponent(il__PLUGIN_NAME__Plugin::PLUGIN_ID);

        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                switch ($cmd) {
                    case self::CMD_SHOW_CONTENTS:
                        // Read commands
                        if (!ilObj__PLUGIN_NAME__Access::hasReadAccess()) {
                            ilObj__PLUGIN_NAME__Access::redirectNonAccess(ilRepositoryGUI::class);
                        }

                        $this->{$cmd}();
                        break;

                    case self::CMD_MANAGE_CONTENTS:
                    case self::CMD_SETTINGS:
                    case self::CMD_SETTINGS_STORE:
                        // Write commands
                        if (!ilObj__PLUGIN_NAME__Access::hasWriteAccess()) {
                            ilObj__PLUGIN_NAME__Access::redirectNonAccess($this);
                        }

                        $this->{$cmd}();
                        break;

                    default:
                        // Unknown command
                        ilObj__PLUGIN_NAME__Access::redirectNonAccess(ilRepositoryGUI::class);
                        break;
                }
                break;
        }
    }


    /**
     * @param string $html
     */
    protected function show(string $html)/*: void*/
    {
        if (!self::dic()->ctrl()->isAsynch()) {
            self::dic()->ui()->mainTemplate()->setTitle($this->object->getTitle());

            self::dic()->ui()->mainTemplate()->setDescription($this->object->getDescription());

            if (!$this->object->isOnline()) {
                self::dic()->ui()->mainTemplate()->setAlertProperties([
                    [
                        "alert"    => true,
                        "property" => self::plugin()->translate("status", self::LANG_MODULE_OBJECT),
                        "value"    => self::plugin()->translate("offline", self::LANG_MODULE_OBJECT)
                    ]
                ]);
            }
        }

        self::output()->output($html);
    }


    /**
     * @inheritDoc
     */
    public function initCreateForm(/*string*/ $a_new_type) : ilPropertyFormGUI
    {
        $form = parent::initCreateForm($a_new_type);

        return $form;
    }


    /**
     * @inheritDoc
     *
     * @param ilObj__PLUGIN_NAME__ $a_new_object
     */
    public function afterSave(/*ilObj__PLUGIN_NAME__*/ ilObject $a_new_object)/*: void*/
    {
        parent::afterSave($a_new_object);
    }


    /**
     *
     */
    protected function manageContents()/*: void*/
    {
        self::dic()->tabs()->activateTab(self::TAB_CONTENTS);

        // TODO: Implement manageContents
        $this->show("");
    }


    /**
     *
     */
    protected function showContents()/*: void*/
    {
        self::dic()->tabs()->activateTab(self::TAB_SHOW_CONTENTS);

        // TODO: Implement showContents
        $this->show("");
    }


    /**
     * @return ObjectSettingsFormGUI
     */
    protected function getSettingsForm() : ObjectSettingsFormGUI
    {
        $form = new ObjectSettingsFormGUI($this, $this->object);

        return $form;
    }


    /**
     *
     */
    protected function settings()/*: void*/
    {
        self::dic()->tabs()->activateTab(self::TAB_SETTINGS);

        $form = $this->getSettingsForm();

        self::output()->output($form);
    }


    /**
     *
     */
    protected function settingsStore()/*: void*/
    {
        self::dic()->tabs()->activateTab(self::TAB_SETTINGS);

        $form = $this->getSettingsForm();

        if (!$form->storeForm()) {
            self::output()->output($form);

            return;
        }

        ilUtil::sendSuccess(self::plugin()->translate("saved", self::LANG_MODULE_SETTINGS), true);

        self::dic()->ctrl()->redirect($this, self::CMD_SETTINGS);
    }


    /**
     *
     */
    protected function setTabs()/*: void*/
    {
        self::dic()->tabs()->addTab(self::TAB_SHOW_CONTENTS, self::plugin()->translate("show_contents", self::LANG_MODULE_OBJECT), self::dic()->ctrl()
            ->getLinkTarget($this, self::CMD_SHOW_CONTENTS));

        if (ilObj__PLUGIN_NAME__Access::hasWriteAccess()) {
            self::dic()->tabs()->addTab(self::TAB_CONTENTS, self::plugin()->translate("manage_contents", self::LANG_MODULE_OBJECT), self::dic()
                ->ctrl()->getLinkTarget($this, self::CMD_MANAGE_CONTENTS));

            self::dic()->tabs()->addTab(self::TAB_SETTINGS, self::plugin()->translate("settings", self::LANG_MODULE_SETTINGS), self::dic()->ctrl()
                ->getLinkTarget($this, self::CMD_SETTINGS));
        }

        if (ilObj__PLUGIN_NAME__Access::hasEditPermissionAccess()) {
            self::dic()->tabs()->addTab(self::TAB_PERMISSIONS, self::plugin()->translate(self::TAB_PERMISSIONS, "", [], false), self::dic()->ctrl()
                ->getLinkTargetByClass([
                    self::class,
                    ilPermissionGUI::class
                ], self::CMD_PERMISSIONS));
        }

        self::dic()->tabs()->manual_activation = true; // Show all tabs as links when no activation
    }


    /**
     * @return string
     */
    public static function getStartCmd() : string
    {
        if (ilObj__PLUGIN_NAME__Access::hasWriteAccess()) {
            return self::CMD_MANAGE_CONTENTS;
        } else {
            return self::CMD_SHOW_CONTENTS;
        }
    }


    /**
     * @inheritDoc
     */
    public function getAfterCreationCmd() : string
    {
        return self::getStartCmd();
    }


    /**
     * @inheritDoc
     */
    public function getStandardCmd() : string
    {
        return self::getStartCmd();
    }
}
