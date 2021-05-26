<?php

namespace srag\DIC\SrPluginGenerator\DIC;

use ILIAS\DI\Container;
use srag\DIC\SrPluginGenerator\Database\DatabaseDetector;
use srag\DIC\SrPluginGenerator\Database\DatabaseInterface;

/**
 * Class AbstractDIC
 *
 * @package srag\DIC\SrPluginGenerator\DIC
 */
abstract class AbstractDIC implements DICInterface
{

    /**
     * @var Container
     */
    protected $dic;


    /**
     * @inheritDoc
     */
    public function __construct(Container &$dic)
    {
        $this->dic = &$dic;
    }


    /**
     * @inheritDoc
     */
    public function database() : DatabaseInterface
    {
        return DatabaseDetector::getInstance($this->databaseCore());
    }
}
