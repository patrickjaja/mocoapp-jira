<?php

namespace Pyz\Yves\ErrorPage;

use SprykerShop\Yves\ErrorPage\ErrorPageDependencyProvider as SprykerErrorPageDependencyProvider;
use SprykerShop\Yves\ErrorPage\Plugin\ExceptionHandler\SubRequestExceptionHandlerPlugin;

class ErrorPageDependencyProvider extends SprykerErrorPageDependencyProvider
{
    /**
     * @return \SprykerShop\Yves\ErrorPage\Dependency\Plugin\ExceptionHandlerPluginInterface[]
     */
    protected function getExceptionHandlerPlugins()
    {
        return [
            new SubRequestExceptionHandlerPlugin(),
        ];
    }
}
