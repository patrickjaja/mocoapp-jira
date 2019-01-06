<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage;

use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use Spryker\Yves\Kernel\Plugin\Pimple;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerAccessPermissionClientBridge;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientBridge;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToProductBundleClientBridge;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToQuoteClientBridge;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToSalesClientBridge;
use Pyz\Yves\CustomerPage\Dependency\Service\CustomerPageToUtilValidateServiceBridge;
use Pyz\Yves\CustomerPage\Plugin\AuthenticationHandler;
use Pyz\Yves\CustomerPage\Plugin\GuestCheckoutAuthenticationHandlerPlugin;
use Pyz\Yves\CustomerPage\Plugin\LoginCheckoutAuthenticationHandlerPlugin;
use Pyz\Yves\CustomerPage\Plugin\RegistrationCheckoutAuthenticationHandlerPlugin;

class CustomerPageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';
    public const CLIENT_SALES = 'CLIENT_SALES';
    public const CLIENT_PRODUCT_BUNDLE = 'CLIENT_PRODUCT_BUNDLE';
    public const CLIENT_CUSTOMER_ACCESS_PERMISSION = 'CLIENT_CUSTOMER_ACCESS_PERMISSION';
    public const CLIENT_QUOTE = 'CLIENT_QUOTE';
    public const PLUGIN_APPLICATION = 'PLUGIN_APPLICATION';
    public const PLUGIN_AUTHENTICATION_HANDLER = 'PLUGIN_AUTHENTICATION_HANDLER';
    public const PLUGIN_PRE_REGISTRATION_CUSTOMER_TRANSFER_EXPANDER = 'PLUGIN_PRE_REGISTRATION_CUSTOMER_TRANSFER_EXPANDER';
    public const PLUGIN_LOGIN_AUTHENTICATION_HANDLER = 'PLUGIN_LOGIN_AUTHENTICATION_HANDLER';
    public const PLUGIN_GUEST_AUTHENTICATION_HANDLER = 'PLUGIN_GUEST_AUTHENTICATION_HANDLER';
    public const PLUGIN_REGISTRATION_AUTHENTICATION_HANDLER = 'PLUGIN_REGISTRATION_AUTHENTICATION_HANDLER';
    public const FLASH_MESSENGER = 'FLASH_MESSENGER';
    public const STORE = 'STORE';
    public const PLUGIN_CUSTOMER_OVERVIEW_WIDGETS = 'PLUGIN_CUSTOMER_OVERVIEW_WIDGETS';
    public const PLUGIN_CUSTOMER_ORDER_LIST_WIDGETS = 'PLUGIN_CUSTOMER_ORDER_LIST_WIDGETS';
    public const PLUGIN_CUSTOMER_ORDER_VIEW_WIDGETS = 'PLUGIN_CUSTOMER_ORDER_VIEW_WIDGETS';
    public const SERVICE_UTIL_VALIDATE = 'SERVICE_UTIL_VALIDATE';

    public const PLUGIN_CUSTOMER_MENU_ITEM_WIDGETS = 'PLUGIN_CUSTOMER_MENU_ITEM_WIDGETS';
    public const PLUGIN_AFTER_LOGIN_CUSTOMER_REDIRECT = 'PLUGIN_AFTER_LOGIN_CUSTOMER_REDIRECT';

    public const PLUGIN_AFTER_CUSTOMER_AUTHENTICATION_SUCCESS = 'PLUGIN_AFTER_CUSTOMER_AUTHENTICATION_SUCCESS';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addCustomerClient($container);
        $container = $this->addCustomerAccessPermissionClient($container);
        $container = $this->addSalesClient($container);
        $container = $this->addProductGroupClient($container);
        $container = $this->addQuoteClient($container);
        $container = $this->addApplication($container);
        $container = $this->addAuthenticationHandlerPlugin($container);
        $container = $this->addLoginCheckoutAuthenticationHandlerPlugin($container);
        $container = $this->addGuestCheckoutAuthenticationHandlerPlugin($container);
        $container = $this->addRegistrationCheckoutAuthenticationHandlerPlugin($container);
        $container = $this->addFlashMessenger($container);
        $container = $this->addStore($container);
        $container = $this->addCustomerOverviewWidgetPlugins($container);
        $container = $this->addCustomerOrderListWidgetPlugins($container);
        $container = $this->addCustomerOrderViewWidgetPlugins($container);
        $container = $this->addCustomerMenuItemWidgetPlugins($container);
        $container = $this->addUtilValidateService($container);
        $container = $this->addPreRegistrationCustomerTransferExpanderPlugins($container);
        $container = $this->addAfterLoginCustomerRedirectPlugins($container);
        $container = $this->addAfterCustomerAuthenticationSuccessPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStore(Container $container)
    {
        $container[static::STORE] = function () {
            return Store::getInstance();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addApplication(Container $container): Container
    {
        $container[self::PLUGIN_APPLICATION] = function () {
            $pimplePlugin = new Pimple();

            return $pimplePlugin->getApplication();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAuthenticationHandlerPlugin(Container $container): Container
    {
        $container[self::PLUGIN_AUTHENTICATION_HANDLER] = function () {
            return new AuthenticationHandler();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addLoginCheckoutAuthenticationHandlerPlugin(Container $container): Container
    {
        $container[self::PLUGIN_LOGIN_AUTHENTICATION_HANDLER] = function () {
            return new LoginCheckoutAuthenticationHandlerPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addGuestCheckoutAuthenticationHandlerPlugin(Container $container): Container
    {
        $container[self::PLUGIN_GUEST_AUTHENTICATION_HANDLER] = function () {
            return new GuestCheckoutAuthenticationHandlerPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addRegistrationCheckoutAuthenticationHandlerPlugin(Container $container): Container
    {
        $container[self::PLUGIN_REGISTRATION_AUTHENTICATION_HANDLER] = function () {
            return new RegistrationCheckoutAuthenticationHandlerPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addFlashMessenger(Container $container): Container
    {
        $container[self::FLASH_MESSENGER] = function (Container $container) {
            return $container[self::PLUGIN_APPLICATION]['flash_messenger'];
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCustomerClient(Container $container): Container
    {
        $container[self::CLIENT_CUSTOMER] = function (Container $container) {
            return new CustomerPageToCustomerClientBridge($container->getLocator()->customer()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCustomerAccessPermissionClient(Container $container): Container
    {
        $container[self::CLIENT_CUSTOMER_ACCESS_PERMISSION] = function (Container $container) {
            return new CustomerPageToCustomerAccessPermissionClientBridge($container->getLocator()->customerAccessPermission()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addQuoteClient(Container $container): Container
    {
        $container[static::CLIENT_QUOTE] = function (Container $container) {
            return new CustomerPageToQuoteClientBridge($container->getLocator()->quote()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addSalesClient(Container $container): Container
    {
        $container[self::CLIENT_SALES] = function (Container $container) {
            return new CustomerPageToSalesClientBridge($container->getLocator()->sales()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addProductGroupClient(Container $container): Container
    {
        $container[self::CLIENT_PRODUCT_BUNDLE] = function (Container $container) {
            return new CustomerPageToProductBundleClientBridge($container->getLocator()->productBundle()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCustomerOverviewWidgetPlugins(Container $container): Container
    {
        $container[static::PLUGIN_CUSTOMER_OVERVIEW_WIDGETS] = function () {
            return $this->getCustomerOverviewWidgetPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCustomerOrderListWidgetPlugins(Container $container): Container
    {
        $container[static::PLUGIN_CUSTOMER_ORDER_LIST_WIDGETS] = function () {
            return $this->getCustomerOrderListWidgetPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCustomerOrderViewWidgetPlugins(Container $container): Container
    {
        $container[static::PLUGIN_CUSTOMER_ORDER_VIEW_WIDGETS] = function () {
            return $this->getCustomerOrderViewWidgetPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCustomerMenuItemWidgetPlugins(Container $container): Container
    {
        $container[static::PLUGIN_CUSTOMER_MENU_ITEM_WIDGETS] = function () {
            return $this->getCustomerMenuItemWidgetPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addUtilValidateService(Container $container): Container
    {
        $container[self::SERVICE_UTIL_VALIDATE] = function (Container $container) {
            return new CustomerPageToUtilValidateServiceBridge($container->getLocator()->utilValidate()->service());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addPreRegistrationCustomerTransferExpanderPlugins(Container $container): Container
    {
        $container[self::PLUGIN_PRE_REGISTRATION_CUSTOMER_TRANSFER_EXPANDER] = function () {
            return $this->getPreRegistrationCustomerTransferExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \Pyz\Yves\CustomerPageExtension\Dependency\Plugin\PreRegistrationCustomerTransferExpanderPluginInterface[]
     */
    protected function getPreRegistrationCustomerTransferExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAfterLoginCustomerRedirectPlugins(Container $container): Container
    {
        $container[static::PLUGIN_AFTER_LOGIN_CUSTOMER_REDIRECT] = function () {
            return $this->getAfterLoginCustomerRedirectPlugins();
        };

        return $container;
    }

    /**
     * @return \Pyz\Yves\CustomerPageExtension\Dependency\Plugin\CustomerRedirectStrategyPluginInterface[]
     */
    protected function getAfterLoginCustomerRedirectPlugins(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    protected function getCustomerOrderListWidgetPlugins(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    protected function getCustomerOrderViewWidgetPlugins(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    protected function getCustomerMenuItemWidgetPlugins(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    protected function getCustomerOverviewWidgetPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAfterCustomerAuthenticationSuccessPlugins(Container $container): Container
    {
        $container[static::PLUGIN_AFTER_CUSTOMER_AUTHENTICATION_SUCCESS] = function () {
            return $this->getAfterCustomerAuthenticationSuccessPlugins();
        };

        return $container;
    }

    /**
     * @return \Pyz\Yves\AgentPage\Plugin\FixAgentTokenAfterCustomerAuthenticationSuccessPlugin[]
     */
    protected function getAfterCustomerAuthenticationSuccessPlugins(): array
    {
        return [];
    }
}
