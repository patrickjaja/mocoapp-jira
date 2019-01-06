<?php

namespace Pyz\Zed\CmsPageSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CmsPageSearch\CmsPageSearchConfig as SprykerCmsPageSearchConfig;

class CmsPageSearchConfig extends SprykerCmsPageSearchConfig
{
    /**
     * @return string|null
     */
    public function getCmsPageSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
