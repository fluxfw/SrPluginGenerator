<?php

namespace srag\Plugins\SrPluginGenerator;

use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Access\Ilias;
use srag\Plugins\SrPluginGenerator\Config\Config;
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

    }


    /**
     * @return bool
     */
    public function currentUserHasRole() : bool
    {
        $user_id = $this->ilias()->users()->getUserId();

        $user_roles = self::dic()->rbacreview()->assignedGlobalRoles($user_id);
        $config_roles = Config::getField(Config::KEY_ROLES);

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
        self::dic()->database()->dropTable(Config::TABLE_NAME, false);
        $this->generator()->dropTables();
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
        Config::updateDB();
        $this->generator()->installTables();
    }


    /**
     * @return GeneratorRepository
     */
    public function generator() : GeneratorRepository
    {
        return GeneratorRepository::getInstance();
    }
}
