<?php

namespace Pyz\Zed\Mocoapp;

use GuzzleHttp\Client;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class MocoappDependencyProvider extends AbstractBundleDependencyProvider
{
    public const HTTP_CLIENT = 'HTTP_CLIENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container[self::HTTP_CLIENT] = new Client();
        return $container;
    }
}
