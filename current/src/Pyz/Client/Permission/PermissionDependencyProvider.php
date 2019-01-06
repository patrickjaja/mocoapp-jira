<?php

namespace Pyz\Client\Permission;

use Spryker\Client\CustomerAccessPermission\Plugin\CustomerAccessPermissionStoragePlugin;
use Spryker\Client\Permission\PermissionDependencyProvider as SprykerPermissionDependencyProvider;

class PermissionDependencyProvider extends SprykerPermissionDependencyProvider
{
    /**
     * @return \Spryker\Client\PermissionExtension\Dependency\Plugin\PermissionStoragePluginInterface[]
     */
    protected function getPermissionStoragePlugins(): array
    {
        return [
            new CustomerAccessPermissionStoragePlugin(), #CustomerAccessFeature
        ];
    }

    /**
     * @return \Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface[]
     */
    protected function getPermissionPlugins(): array
    {
        return [];
    }
}
