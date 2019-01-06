<?php

namespace Pyz\Zed\Api;

use Spryker\Zed\Api\ApiDependencyProvider as SprykerApiDependencyProvider;
use Spryker\Zed\Api\Communication\Plugin\ApiRequestTransferFilterHeaderDataPlugin;
use Spryker\Zed\Api\Communication\Plugin\ApiRequestTransferFilterServerDataPlugin;
use Spryker\Zed\CustomerApi\Communication\Plugin\Api\CustomerApiResourcePlugin;
use Spryker\Zed\CustomerApi\Communication\Plugin\Api\CustomerApiValidatorPlugin;

class ApiDependencyProvider extends SprykerApiDependencyProvider
{
    /**
     * @return \Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface[]
     */
    protected function getApiResourcePluginCollection()
    {
        return [
            new CustomerApiResourcePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface[]
     */
    protected function getApiValidatorPluginCollection()
    {
        return [
            new CustomerApiValidatorPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\Api\Communication\Plugin\ApiRequestTransferFilterPluginInterface[]
     */
    protected function getApiRequestTransferFilterPluginCollection(): array
    {
        return [
            new ApiRequestTransferFilterServerDataPlugin(),
            new ApiRequestTransferFilterHeaderDataPlugin(),
        ];
    }
}
