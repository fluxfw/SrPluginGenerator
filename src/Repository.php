<?php

namespace srag\Plugins\SrPluginGenerator;

use ilSrPluginGeneratorPlugin;
use srag\ActiveRecordConfig\SrPluginGenerator\Config\Config;
use srag\ActiveRecordConfig\SrPluginGenerator\Config\Repository as ConfigRepository;
use srag\ActiveRecordConfig\SrPluginGenerator\Utils\ConfigTrait;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Access\Ilias;
use srag\Plugins\SrPluginGenerator\Config\ConfigFormGUI;
use srag\Plugins\SrPluginGenerator\Generator\Repository as GeneratorRepository;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Repository
 *
 * @package srag\Plugins\SrPluginGenerator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Repository
{

    use DICTrait;
    use SrPluginGeneratorTrait;
    use ConfigTrait {
        config as protected _config;
    }
    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    /**
     * @var self
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
     * Repository constructor
     */
    private function __construct()
    {
        $this->config()->withTableName("srplgen_config")->withFields([
            ConfigFormGUI::KEY_ROLES => [Config::TYPE_JSON, []]
        ]);
    }


    /**
     * @inheritDoc
     */
    public function config() : ConfigRepository
    {
        return self::_config();
    }


    /**
     * @return bool
     */
    public function currentUserHasRole() : bool
    {
        $user_id = $this->ilias()->users()->getUserId();

        $user_roles = self::dic()->rbacreview()->assignedGlobalRoles($user_id);
        $config_roles = $this->config()->getField(ConfigFormGUI::KEY_ROLES);

        foreach ($user_roles as $user_role) {
            if (in_array($user_role, $config_roles)) {
                return true;
            }
        }

        return false;
    }


    /**
     *
     */
    public function dropTables()/*:void*/
    {
        $this->config()->dropTables();
        $this->generator()->dropTables();
    }


    /**
     * @return GeneratorRepository
     */
    public function generator() : GeneratorRepository
    {
        return GeneratorRepository::getInstance();
    }


    /**
     * @return Ilias
     */
    public function ilias() : Ilias
    {
        return Ilias::getInstance();
    }


    /**
     *
     */
    public function installTables()/*:void*/
    {
        $this->config()->installTables();
        $this->generator()->installTables();
    }
}
