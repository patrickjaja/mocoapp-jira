<?php

namespace Pyz\Zed\CategoryPageSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CategoryPageSearch\CategoryPageSearchConfig as SprykerCategoryPageSearchConfig;

class CategoryPageSearchConfig extends SprykerCategoryPageSearchConfig
{
    /**
     * @return string
     */
    public function getCategoryPageSynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
