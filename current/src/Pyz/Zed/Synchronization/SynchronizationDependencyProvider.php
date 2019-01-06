<?php

namespace Pyz\Zed\Synchronization;

use Spryker\Zed\CmsBlockStorage\Communication\Plugin\Synchronization\CmsBlockSynchronizationDataPlugin;
use Spryker\Zed\CmsPageSearch\Communication\Plugin\Synchronization\CmsPageSynchronizationDataPlugin;
use Spryker\Zed\CmsStorage\Communication\Plugin\Synchronization\CmsSynchronizationDataPlugin;
use Spryker\Zed\CustomerAccessStorage\Communication\Plugin\Synchronization\CustomerAccessSynchronizationDataPlugin;
use Spryker\Zed\GlossaryStorage\Communication\Plugin\Synchronization\GlossarySynchronizationDataPlugin;
use Spryker\Zed\NavigationStorage\Communication\Plugin\Synchronization\NavigationSynchronizationDataPlugin;
use Spryker\Zed\Synchronization\SynchronizationDependencyProvider as SprykerSynchronizationDependencyProvider;
use Spryker\Zed\UrlStorage\Communication\Plugin\Synchronization\UrlRedirectSynchronizationDataPlugin;
use Spryker\Zed\UrlStorage\Communication\Plugin\Synchronization\UrlSynchronizationDataPlugin;

class SynchronizationDependencyProvider extends SprykerSynchronizationDependencyProvider
{
    /**
     * @return \Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataPluginInterface[]
     */
    protected function getSynchronizationDataPlugins(): array
    {
        return [
            new CmsPageSynchronizationDataPlugin(),
            new CmsBlockSynchronizationDataPlugin(),
            new CmsSynchronizationDataPlugin(),
            new NavigationSynchronizationDataPlugin(),
            new GlossarySynchronizationDataPlugin(),
            new UrlRedirectSynchronizationDataPlugin(),
            new UrlSynchronizationDataPlugin(),
            new CustomerAccessSynchronizationDataPlugin(),
        ];
    }
}
