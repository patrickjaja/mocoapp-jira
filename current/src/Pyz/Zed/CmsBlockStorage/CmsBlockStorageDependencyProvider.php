<?php

namespace Pyz\Zed\CmsBlockStorage;

use Spryker\Zed\CmsBlockStorage\CmsBlockStorageDependencyProvider as SprykerCmsBlockStorageDependencyProvider;
use Spryker\Zed\CmsContentWidget\Communication\Plugin\CmsBlockStorage\CmsBlockStorageStorageParameterMapExpanderPlugin;

class CmsBlockStorageDependencyProvider extends SprykerCmsBlockStorageDependencyProvider
{
    /**
     * @return \Spryker\Zed\CmsBlockStorage\Dependency\Plugin\CmsBlockStorageDataExpanderPluginInterface[]
     */
    protected function getContentWidgetDataExpanderPlugins()
    {
        return [
            new CmsBlockStorageStorageParameterMapExpanderPlugin(),
        ];
    }
}
