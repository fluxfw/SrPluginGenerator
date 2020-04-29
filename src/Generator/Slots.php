<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Slots
 *
 * @package srag\Plugins\SrPluginGenerator\Generator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Slots
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const SLOTS_TEMPLATE_DIR = __DIR__ . "/../../templates/slots";
    const BASE_COMPONENT_MODULES = IL_COMP_MODULE;
    const BASE_COMPONENT_SERVICES = IL_COMP_SERVICE;
    const COMPONENT_ADVANCED_META_DATA = "AdvancedMetaData";
    const COMPONENT_AUTHENTICATION = "Authentication";
    const COMPONENT_AUTH_SHIBBOLETH = "AuthShibboleth";
    const COMPONENT_CLOUD = "Cloud";
    const COMPONENT_CO_PAGE = "COPage";
    const COMPONENT_CRON = "Cron";
    const COMPONENT_DATA_COLLECTION = "DataCollection";
    const COMPONENT_EVENT_HANDLING = "EventHandling";
    const COMPONENT_LDAP = "LDAP";
    const COMPONENT_ORG_UNIT = "OrgUnit";
    const COMPONENT_PERSONAL_DESKTOP = "PersonalDesktop";
    const COMPONENT_PREVIEW = "Preview";
    const COMPONENT_REPOSITORY = "Repository";
    const COMPONENT_SURVEY_QUESTION_POOL = "SurveyQuestionPool";
    const COMPONENT_TEST = "Test";
    const COMPONENT_TEST_QUESTION_POOL = "TestQuestionPool";
    const COMPONENT_UI_COMPONENT = "UIComponent";
    const COMPONENT_USER = "User";
    const COMPONENT_WORKFLOW_ENGINE = "WorkflowEngine";
    const SLOT_ADVANCED_MD_CLAIMING = "AdvancedMDClaiming";
    const SLOT_AUTHENTICATION_HOOK = "AuthenticationHook";
    const SLOT_CLOUD_HOOK = "CloudHook";
    const SLOT_COMPLEX_GATEWAY = "ComplexGateway";
    const SLOT_CRON_HOOK = "CronHook";
    const SLOT_EVENT_HOOK = "EventHook";
    const SLOT_EXPORT = "Export";
    const SLOT_FIELD_TYPE_HOOK = "FieldTypeHook";
    const SLOT_LDAP_HOOK = "LDAPHook";
    const SLOT_PAGE_COMPONENT = "PageComponent";
    const SLOT_ORG_UNIT_EXTENSION = "OrgUnitExtension";
    const SLOT_ORG_UNIT_TYPE_HOOK = "OrgUnitTypeHook";
    const SLOT_QUESTIONS = "Questions";
    const SLOT_PERSONAL_DESKTOP_HOOK = "PersonalDesktopHook";
    const SLOT_PREVIEW_RENDERER = "PreviewRenderer";
    const SLOT_REPOSITORY_OBJECT = "RepositoryObject";
    const SLOT_SHIBBOLETH_AUTHENTICATION_HOOK = "ShibbolethAuthenticationHook";
    const SLOT_SIGNATURE = "Signature";
    const SLOT_SURVEY_QUESTIONS = "SurveyQuestions";
    const SLOT_UDF_CLAIMING = "UDFClaiming";
    const SLOT_USER_INTERFACE_HOOK = "UserInterfaceHook";
    const CLOUD_HOOK = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_CLOUD . "/" . self::SLOT_CLOUD_HOOK;
    const FIELD_TYPE_HOOK = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_DATA_COLLECTION . "/" . self::SLOT_FIELD_TYPE_HOOK;
    const ORG_UNIT_EXTENSION = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_ORG_UNIT . "/" . self::SLOT_ORG_UNIT_EXTENSION;
    const ORG_UNIT_TYPE_HOOK = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_ORG_UNIT . "/" . self::SLOT_ORG_UNIT_TYPE_HOOK;
    const SURVEY_QUESTIONS = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_SURVEY_QUESTION_POOL . "/" . self::SLOT_SURVEY_QUESTIONS;
    const EXPORT = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_TEST . "/" . self::SLOT_EXPORT;
    const SIGNATURE = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_TEST . "/" . self::SLOT_SIGNATURE;
    const QUESTION = self::BASE_COMPONENT_MODULES . "/" . self::COMPONENT_TEST_QUESTION_POOL . "/" . self::SLOT_QUESTIONS;
    const ADVANCED_MD_CLAIMING = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_ADVANCED_META_DATA . "/" . self::SLOT_ADVANCED_MD_CLAIMING;
    const AUTHENTICATION_HOOK = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_AUTHENTICATION . "/" . self::SLOT_AUTHENTICATION_HOOK;
    const SHIBBOLETH_AUTHENTICATION_HOOK
        = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_AUTH_SHIBBOLETH . "/"
        . self::SLOT_SHIBBOLETH_AUTHENTICATION_HOOK;
    const PAGE_COMPONENT = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_CO_PAGE . "/" . self::SLOT_PAGE_COMPONENT;
    const CRON_HOOK = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_CRON . "/" . self::SLOT_CRON_HOOK;
    const EVENT_HOOK = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_EVENT_HANDLING . "/" . self::SLOT_EVENT_HOOK;
    const LDAP = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_LDAP . "/" . self::SLOT_LDAP_HOOK;
    const PERSONAL_DESKTOP = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_PERSONAL_DESKTOP . "/" . self::SLOT_PERSONAL_DESKTOP_HOOK;
    const PREVIEW_RENDERER = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_PREVIEW . "/" . self::SLOT_PREVIEW_RENDERER;
    const REPOSITORY_OBJECT = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_REPOSITORY . "/" . self::SLOT_REPOSITORY_OBJECT;
    const USER_INTERFACE_HOOK = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_UI_COMPONENT . "/" . self::SLOT_USER_INTERFACE_HOOK;
    const UDF_CLAIMING = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_USER . "/" . self::SLOT_UDF_CLAIMING;
    const COMPLEX_GATEWAY = self::BASE_COMPONENT_SERVICES . "/" . self::COMPONENT_WORKFLOW_ENGINE . "/" . self::SLOT_COMPLEX_GATEWAY;
    /**
     * @var array
     */
    public static $slots
        = [
            self::ADVANCED_MD_CLAIMING,
            self::AUTHENTICATION_HOOK,
            self::CLOUD_HOOK,
            self::COMPLEX_GATEWAY,
            self::CRON_HOOK,
            self::EVENT_HOOK,
            self::EXPORT,
            self::FIELD_TYPE_HOOK,
            self::LDAP,
            self::ORG_UNIT_EXTENSION,
            self::ORG_UNIT_TYPE_HOOK,
            self::PAGE_COMPONENT,
            self::PERSONAL_DESKTOP,
            self::PREVIEW_RENDERER,
            self::QUESTION,
            self::REPOSITORY_OBJECT,
            self::SHIBBOLETH_AUTHENTICATION_HOOK,
            self::SIGNATURE,
            self::SURVEY_QUESTIONS,
            self::UDF_CLAIMING,
            self::USER_INTERFACE_HOOK
        ];
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * Slots constructor
     */
    private function __construct()
    {

    }


    /**
     * @return array
     */
    public function getSlots() : array
    {
        $slots = array_filter(self::$slots, function (string $slot) : bool {
            return self::hasSlot($slot);
        });

        sort($slots);

        return array_combine($slots, $slots);
    }


    /**
     * @param string $slot
     *
     * @return bool
     */
    public function hasSlot(string $slot) : bool
    {
        return is_dir(self::SLOTS_TEMPLATE_DIR . "/" . $slot);
    }
}
