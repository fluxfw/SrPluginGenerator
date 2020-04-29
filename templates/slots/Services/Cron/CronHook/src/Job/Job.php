<?php

namespace __NAMESPACE__\Job;

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use il__PLUGIN_NAME__Plugin;
use ilCronJob;
use ilCronJobResult;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class Job__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Job
 *
 * __AUTHOR_COMMENT__
 */
class Job extends ilCronJob
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;

    const CRON_JOB_ID = il__PLUGIN_NAME__Plugin::PLUGIN_ID . "_cron";
    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;


    /**
     * Job constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function getId() : string
    {
        return self::CRON_JOB_ID;
    }


    /**
     * @inheritDoc
     */
    public function getTitle() : string
    {
        return il__PLUGIN_NAME__Plugin::PLUGIN_NAME;
    }


    /**
     * @inheritDoc
     */
    public function getDescription() : string
    {
        return "";
    }


    /**
     * @inheritDoc
     */
    public function hasAutoActivation() : bool
    {
        return true;
    }


    /**
     * @inheritDoc
     */
    public function hasFlexibleSchedule() : bool
    {
        return true;
    }


    /**
     * @inheritDoc
     */
    public function getDefaultScheduleType() : int
    {
        return self::SCHEDULE_TYPE_DAILY;
    }


    /**
     * @inheritDoc
     */
    public function getDefaultScheduleValue()/* : ?int*/
    {
        return null;
    }


    /**
     * @inheritDoc
     */
    public function run() : ilCronJobResult
    {
        $result = new ilCronJobResult();

        // TODO: Implement run

        $result->setStatus(ilCronJobResult::STATUS_OK);

        return $result;
    }
}
