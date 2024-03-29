<?php

namespace srag\RemovePluginDataConfirm\SrPluginGenerator;

/**
 * Trait PluginUninstallTrait
 *
 * @package srag\RemovePluginDataConfirm\SrPluginGenerator
 */
trait PluginUninstallTrait
{

    use BasePluginUninstallTrait;

    /**
     * @internal
     */
    protected final function afterUninstall() : void
    {

    }


    /**
     * @return bool
     *
     * @internal
     */
    protected final function beforeUninstall() : bool
    {
        return $this->pluginUninstall();
    }
}
