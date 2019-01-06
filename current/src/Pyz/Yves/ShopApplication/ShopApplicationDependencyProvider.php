<?php

namespace Pyz\Yves\ShopApplication;

use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getGlobalWidgets(): array
    {
        return [];
    }

    /**
     * @return \SprykerShop\Yves\ShopApplicationExtension\Dependency\Plugin\FilterControllerEventHandlerPluginInterface[]
     */
    protected function getFilterControllerEventSubscriberPlugins(): array
    {
        return [];
    }
}
