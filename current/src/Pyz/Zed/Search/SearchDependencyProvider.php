<?php

namespace Pyz\Zed\Search;

use Spryker\Zed\CategoryPageSearch\Communication\Plugin\Search\CategoryNodeDataPageMapBuilder;
use Spryker\Zed\CmsPageSearch\Communication\Plugin\Search\CmsDataPageMapBuilder;
use Spryker\Zed\Search\SearchDependencyProvider as SprykerSearchDependencyProvider;

class SearchDependencyProvider extends SprykerSearchDependencyProvider
{
    /**
     * @return \Spryker\Zed\Search\Dependency\Plugin\PageMapInterface[]
     */
    protected function getSearchPageMapPlugins()
    {
        return [
            new CmsDataPageMapBuilder(),
            new CategoryNodeDataPageMapBuilder(),
        ];
    }
}
