<?php

namespace srag\DIC\SrPluginGenerator\Plugin;

/**
 * Interface Pluginable
 *
 * @package srag\DIC\SrPluginGenerator\Plugin
 */
interface Pluginable
{

    /**
     * @return PluginInterface
     */
    public function getPlugin() : PluginInterface;


    /**
     * @param PluginInterface $plugin
     *
     * @return static
     */
    public function withPlugin(PluginInterface $plugin)/*: static*/ ;
}
