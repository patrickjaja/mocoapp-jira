<?php

namespace Pyz\Zed\Url;

use Spryker\Zed\Navigation\Communication\Plugin\DetachNavigationUrlAfterUrlDeletePlugin;
use Spryker\Zed\Url\UrlDependencyProvider as SprykerUrlDependencyProvider;

class UrlDependencyProvider extends SprykerUrlDependencyProvider
{
    /**
     * @return \Spryker\Zed\Url\Dependency\Plugin\UrlDeletePluginInterface[]
     */
    protected function getUrlBeforeDeletePlugins()
    {
        return [
            new DetachNavigationUrlAfterUrlDeletePlugin(),
        ];
    }
}
