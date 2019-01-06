<?php

namespace Pyz\Zed\CmsStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CmsStorage\CmsStorageConfig as SprykerCmsStorageConfig;

class CmsStorageConfig extends SprykerCmsStorageConfig
{
    /**
     * @return string|null
     */
    public function getCmsPageSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
