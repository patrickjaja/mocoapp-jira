<?php

namespace Pyz\Zed\WebProfiler;

use Spryker\Shared\WebProfiler\Plugin\ServiceProvider\WebProfilerServiceProvider;
use Spryker\Zed\Config\Communication\Plugin\ServiceProvider\ConfigProfilerServiceProvider;
use Spryker\Zed\WebProfiler\WebProfilerDependencyProvider as SprykerWebProfilerDependencyProvider;

class WebProfilerDependencyProvider extends SprykerWebProfilerDependencyProvider
{
    /**
     * @return array
     */
    public function getWebProfilerPlugins()
    {
        return [
            new WebProfilerServiceProvider(),
            new ConfigProfilerServiceProvider(),
        ];
    }
}
