<?php

namespace Pyz\Zed\Installer;

use Spryker\Zed\Acl\Communication\Plugin\AclInstallerPlugin;
use Spryker\Zed\Country\Communication\Plugin\CountryInstallerPlugin;
use Spryker\Zed\CustomerAccess\Communication\Plugin\CustomerAccessInstallerPlugin;
use Spryker\Zed\Glossary\Communication\Plugin\GlossaryInstallerPlugin;
use Spryker\Zed\Installer\InstallerDependencyProvider as SprykerInstallerDependencyProvider;
use Spryker\Zed\Locale\Communication\Plugin\LocaleInstallerPlugin;
use Spryker\Zed\OauthCustomerConnector\Communication\Plugin\Installer\OauthCustomerInstallerPlugin;
use Spryker\Zed\User\Communication\Plugin\UserInstallerPlugin;

class InstallerDependencyProvider extends SprykerInstallerDependencyProvider
{
    /**
     * @return \Spryker\Zed\Installer\Dependency\Plugin\InstallerPluginInterface[]
     */
    public function getInstallerPlugins()
    {
        return [
            new LocaleInstallerPlugin(),
            new CountryInstallerPlugin(),
            new UserInstallerPlugin(),
            new AclInstallerPlugin(),
            new GlossaryInstallerPlugin(),
            new CustomerAccessInstallerPlugin(),
            new OauthCustomerInstallerPlugin(),
        ];
    }
}
