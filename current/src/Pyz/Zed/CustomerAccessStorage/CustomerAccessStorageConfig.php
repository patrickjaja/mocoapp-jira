<?php

namespace Pyz\Zed\CustomerAccessStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CustomerAccessStorage\CustomerAccessStorageConfig as SprykerCustomerAccessStorageConfig;

class CustomerAccessStorageConfig extends SprykerCustomerAccessStorageConfig
{
    /**
     * @return string|null
     */
    public function getSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
