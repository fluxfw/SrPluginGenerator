<?php

namespace srag\Plugins\SrPluginGenerator\Generator;

use ilSrPluginGeneratorPlugin;
use JsonSerializable;
use srag\DIC\SrPluginGenerator\DICTrait;
use srag\Plugins\SrPluginGenerator\Utils\SrPluginGeneratorTrait;
use stdClass;

/**
 * Class Options
 *
 * @package srag\Plugins\SrPluginGenerator\Generator
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class Options implements JsonSerializable
{

    use DICTrait;
    use SrPluginGeneratorTrait;

    const PLUGIN_CLASS_NAME = ilSrPluginGeneratorPlugin::class;
    const DEFAULT_NAMESPACE = "srag\\Plugins\\__PLUGIN_NAME__\\";
    const DEFAULT_RESPONSIBLE_NAME = "studer + raimann ag - Team Custom 1";
    const DEFAULT_RESPONSIBLE_EMAIL = "support-custom1@studer-raimann.ch";
    /**
     * @var string
     */
    protected $plugin_id = "";
    /**
     * @var string
     */
    protected $project_key = "";
    /**
     * @var string
     */
    protected $plugin_name = "";
    /**
     * @var string
     */
    protected $plugin_slot = "";
    /**
     * @var string
     */
    protected $namespace = self::DEFAULT_NAMESPACE;
    /**
     * @var string
     */
    protected $responsible_name = self::DEFAULT_RESPONSIBLE_NAME;
    /**
     * @var string
     */
    protected $responsible_email = self::DEFAULT_RESPONSIBLE_EMAIL;


    /**
     * Options constructor
     */
    public function __construct()
    {

    }


    /**
     * @return string
     */
    public function getPluginId() : string
    {
        return $this->plugin_id;
    }


    /**
     * @param string $plugin_id
     */
    public function setPluginId(string $plugin_id)/*: void*/
    {
        $this->plugin_id = $plugin_id;
    }


    /**
     * @return string
     */
    public function getProjectKey() : string
    {
        return $this->project_key;
    }


    /**
     * @param string $project_key
     */
    public function setProjectKey(string $project_key)/*: void*/
    {
        $this->project_key = $project_key;
    }


    /**
     * @return string
     */
    public function getPluginName() : string
    {
        return $this->plugin_name;
    }


    /**
     * @param string $plugin_name
     */
    public function setPluginName(string $plugin_name)/*: void*/
    {
        $this->plugin_name = $plugin_name;
    }


    /**
     * @return string
     */
    public function getPluginSlot() : string
    {
        return $this->plugin_slot;
    }


    /**
     * @param string $plugin_slot
     */
    public function setPluginSlot(string $plugin_slot)/*: void*/
    {
        $this->plugin_slot = $plugin_slot;
    }


    /**
     * @return string
     */
    public function getNamespace() : string
    {
        return $this->namespace;
    }


    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace)/*: void*/
    {
        $this->namespace = $namespace;
    }


    /**
     * @return string
     */
    public function getResponsibleName() : string
    {
        return $this->responsible_name;
    }


    /**
     * @param string $responsible_name
     */
    public function setResponsibleName(string $responsible_name)/*: void*/
    {
        $this->responsible_name = $responsible_name;
    }


    /**
     * @return string
     */
    public function getResponsibleEmail() : string
    {
        return $this->responsible_email;
    }


    /**
     * @param string $responsible_email
     */
    public function setResponsibleEmail(string $responsible_email)/*: void*/
    {
        $this->responsible_email = $responsible_email;
    }


    /**
     * @inheritDoc
     *
     * @return stdClass
     */
    public function jsonSerialize() : stdClass
    {
        return (object) get_object_vars($this);
    }
}
