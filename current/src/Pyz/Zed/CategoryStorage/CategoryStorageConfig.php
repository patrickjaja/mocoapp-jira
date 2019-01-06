<?php

namespace Pyz\Zed\CategoryStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CategoryStorage\CategoryStorageConfig as SprykerCategoryStorageConfig;

class CategoryStorageConfig extends SprykerCategoryStorageConfig
{
    /**
     * @return string|null
     */
    public function getCategoryTreeSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return string|null
     */
    public function getCategoryNodeSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
