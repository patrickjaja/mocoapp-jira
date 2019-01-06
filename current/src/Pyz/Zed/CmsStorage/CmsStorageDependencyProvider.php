<?php

namespace Pyz\Zed\CmsStorage;

use Spryker\Zed\CmsContentWidget\Communication\Plugin\CmsPageDataExpander\CmsPageParameterMapExpanderPlugin;
use Spryker\Zed\CmsStorage\CmsStorageDependencyProvider as SprykerCmsStorageDependencyProvider;

class CmsStorageDependencyProvider extends SprykerCmsStorageDependencyProvider
{
    /**
     * @return \Spryker\Zed\Cms\Dependency\Plugin\CmsPageDataExpanderPluginInterface[]
     */
    protected function getContentWidgetDataExpander()
    {
        return [
            new CmsPageParameterMapExpanderPlugin(),
        ];
    }
}
