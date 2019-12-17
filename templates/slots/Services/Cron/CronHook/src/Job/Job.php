<?php

namespace __NAMESPACE__\Job;

use il__PLUGIN_NAME__Plugin;
use ilCronJob;
use ilCronJobResult;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class Job__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Job
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  __RESPONSIBLE_NAME__ <__RESPONSIBLE_EMAIL__>
 */
class Job extends ilCronJob
{

    use DICTrait;
    const CRON_JOB_ID = "__PLUGIN_ID___cron";
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;


    /**
     * Job constructor
     */
    public function __construct()
    {

    }


    /**
     * Get id
     *
     * @return string
     */
    public function getId() : string
    {
        return self::CRON_JOB_ID;
    }


    /**
     * @return string
     */
    public function getTitle() : string
    {
        return il__PLUGIN_NAME__Plugin::PLUGIN_NAME;
    }


    /**
     * @return string
     */
    public function getDescription() : string
    {
        return "";
    }


    /**
     * Is to be activated on "installation"
     *
     * @return boolean
     */
    public function hasAutoActivation() : bool
    {
        return true;
    }


    /**
     * Can the schedule be configured?
     *
     * @return boolean
     */
    public function hasFlexibleSchedule() : bool
    {
        return true;
    }


    /**
     * Get schedule type
     *
     * @return int
     */
    public function getDefaultScheduleType() : int
    {
        return self::SCHEDULE_TYPE_DAILY;
    }


    /**
     * Get schedule value
     *
     * @return int|array
     */
    public function getDefaultScheduleValue()
    {
        return null;
    }


    /**
     * Run job
     *
     * @return ilCronJobResult
     */
    public function run() : ilCronJobResult
    {
        $result = new ilCronJobResult();

        // TODO: Implement run

        $result->setStatus(ilCronJobResult::STATUS_OK);

        return $result;
    }
}
