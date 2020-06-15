<?php

namespace __NAMESPACE__\Job;

use __NAMESPACE__\Utils\__PLUGIN_NAME__Trait;
use ilCronJob;
use srag\DIC\__PLUGIN_NAME__\DICTrait;

/**
 * Class Factory__VERSION_COMMENT__
 *
 * @package __NAMESPACE__\Job
 *
 * __AUTHOR_COMMENT__
 */
final class Factory
{

    use DICTrait;
    use __PLUGIN_NAME__Trait;

    const PLUGIN_CLASS_NAME = il__PLUGIN_NAME__Plugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Factory constructor
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
     * @param string $job_id
     *
     * @return ilCronJob|null
     */
    public function newInstanceById(string $job_id) : ?ilCronJob
    {
        switch ($job_id) {
            case Job::CRON_JOB_ID:
                return $this->newJobInstance();

            default:
                return null;
        }
    }


    /**
     * @return ilCronJob[]
     */
    public function newInstances() : array
    {
        return [
            $this->newJobInstance()
        ];
    }


    /**
     * @return Job
     */
    public function newJobInstance() : Job
    {
        $job = new Job();

        return $job;
    }
}
