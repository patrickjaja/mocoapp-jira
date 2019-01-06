<?php

namespace Pyz\Client\CmsPageSearch;

use Spryker\Client\CmsPageSearch\CmsPageSearchDependencyProvider as SprykerCmsPageSearchDependencyProvider;
use Spryker\Client\CmsPageSearch\Plugin\Elasticsearch\QueryExpander\PaginatedCmsPageQueryExpanderPlugin;
use Spryker\Client\CmsPageSearch\Plugin\Elasticsearch\QueryExpander\SortedCmsPageQueryExpanderPlugin;
use Spryker\Client\CmsPageSearch\Plugin\Elasticsearch\ResultFormatter\PaginatedCmsPageResultFormatterPlugin;
use Spryker\Client\CmsPageSearch\Plugin\Elasticsearch\ResultFormatter\RawCmsPageSearchResultFormatterPlugin;
use Spryker\Client\CmsPageSearch\Plugin\Elasticsearch\ResultFormatter\SortedCmsPageSearchResultFormatterPlugin;
use Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander\IsActiveQueryExpanderPlugin;
use Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander\LocalizedQueryExpanderPlugin;
use Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander\StoreQueryExpanderPlugin;

class CmsPageSearchDependencyProvider extends SprykerCmsPageSearchDependencyProvider
{
    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createCmsPageSearchQueryExpanderPlugins(): array
    {
        return [
            new StoreQueryExpanderPlugin(),
            new LocalizedQueryExpanderPlugin(),
            new SortedCmsPageQueryExpanderPlugin(),
            new PaginatedCmsPageQueryExpanderPlugin(),
            new IsActiveQueryExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function createCmsPageSearchResultFormatterPlugins(): array
    {
        return [
            new SortedCmsPageSearchResultFormatterPlugin(),
            new PaginatedCmsPageResultFormatterPlugin(),
            new RawCmsPageSearchResultFormatterPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createCmsPageSearchCountQueryExpanderPlugins(): array
    {
        return [
            new StoreQueryExpanderPlugin(),
            new LocalizedQueryExpanderPlugin(),
            new IsActiveQueryExpanderPlugin(),
        ];
    }
}
