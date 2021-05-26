<?php

namespace srag\Plugins\SrPluginGenerator\Access;

use ilSrPluginGeneratorPlugin;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;

/**
 * Class Roles
 *
 * @package srag\Plugins\SrPluginGenerator\Access
 */
final class Roles
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Roles constructor
     */
    private function __construct()
    {

    }


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
     * @return array
     */
    public function getAllRoles() : array
    {
        /**
         * @var array $global_roles
         * @var array $roles
         */

        $global_roles = self::dic()->rbac()->review()->getRolesForIDs(self::dic()->rbac()->review()->getGlobalRoles(), false);

        $roles = [];
        foreach ($global_roles as $global_role) {
            $roles[$global_role["rol_id"]] = $global_role["title"];
        }

        return $roles;
    }
}
