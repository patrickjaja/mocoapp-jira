<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\NavigationStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\NavigationStorage\NavigationStorageConfig as SprykerNavigationStorageConfig;

class NavigationStorageConfig extends SprykerNavigationStorageConfig
{
    /**
     * @return string|null
     */
    public function getNavigationSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
