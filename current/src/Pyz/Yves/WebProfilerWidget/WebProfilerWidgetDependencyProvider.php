<?php

namespace Pyz\Yves\WebProfilerWidget;

use Spryker\Shared\WebProfiler\Plugin\ServiceProvider\WebProfilerServiceProvider;
use Spryker\Yves\Config\Plugin\ServiceProvider\ConfigProfilerServiceProvider;
use SprykerShop\Yves\WebProfilerWidget\WebProfilerWidgetDependencyProvider as SprykerWebProfilerDependencyProvider;

class WebProfilerWidgetDependencyProvider extends SprykerWebProfilerDependencyProvider
{
    /**
     * @return array
     */
    protected function getWebProfilerPlugins()
    {
        return [
            new WebProfilerServiceProvider(),
            new ConfigProfilerServiceProvider(),
        ];
    }
}
