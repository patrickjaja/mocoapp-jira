<?php

namespace Pyz\Zed\TimeAccounting;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class TimeAccountingDependencyProvider extends AbstractBundleDependencyProvider
{
    public const JIRA_CLIENT = 'JIRA_CLIENT';
    public const MOCO_CLIENT = 'MOCO_CLIENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        //ToDo: Add time entries plugin sources
        $container[self::JIRA_CLIENT] = $container->getLocator()->jira()->facade();
        $container[self::MOCO_CLIENT] = $container->getLocator()->mocoapp()->facade();
        return $container;
    }
}
