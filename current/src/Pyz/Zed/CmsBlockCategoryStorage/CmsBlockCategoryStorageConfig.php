<?php

namespace Pyz\Zed\CmsBlockCategoryStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CmsBlockCategoryStorage\CmsBlockCategoryStorageConfig as SprykerCmsBlockCategoryStorageConfig;

class CmsBlockCategoryStorageConfig extends SprykerCmsBlockCategoryStorageConfig
{
    /**
     * @return string|null
     */
    public function getCmsBlockCategorySynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
