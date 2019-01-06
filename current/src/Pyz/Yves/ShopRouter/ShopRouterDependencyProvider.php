<?php

namespace Pyz\Yves\ShopRouter;

use SprykerShop\Yves\CmsPage\Plugin\PageResourceCreatorPlugin;
use SprykerShop\Yves\RedirectPage\Plugin\RedirectResourceCreatorPlugin;
use SprykerShop\Yves\ShopRouter\ShopRouterDependencyProvider as SprykerShopRouterDependencyProvider;

class ShopRouterDependencyProvider extends SprykerShopRouterDependencyProvider
{
    /**
     * @return \SprykerShop\Yves\ShopRouterExtension\Dependency\Plugin\ResourceCreatorPluginInterface[]
     */
    protected function getResourceCreatorPlugins()
    {
        return [
            new PageResourceCreatorPlugin(),
            new RedirectResourceCreatorPlugin(),
        ];
    }
}
