<?php

namespace Pyz\Client\UrlStorage;

use Spryker\Client\CategoryStorage\Plugin\UrlStorageCategoryNodeMapperPlugin;
use Spryker\Client\CmsStorage\Plugin\UrlStorageCmsPageMapperPlugin;
use Spryker\Client\UrlStorage\Plugin\UrlStorageRedirectMapperPlugin;
use Spryker\Client\UrlStorage\UrlStorageDependencyProvider as SprykerUrlDependencyProvider;

class UrlStorageDependencyProvider extends SprykerUrlDependencyProvider
{
    /**
     * @return \Spryker\Client\UrlStorage\Dependency\Plugin\UrlStorageResourceMapperPluginInterface[]
     */
    protected function getUrlStorageResourceMapperPlugins()
    {
        return [
            new UrlStorageCmsPageMapperPlugin(),
            new UrlStorageCategoryNodeMapperPlugin(),
            new UrlStorageRedirectMapperPlugin(),
        ];
    }
}
