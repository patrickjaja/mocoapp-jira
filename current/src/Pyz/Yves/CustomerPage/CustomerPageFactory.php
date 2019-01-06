<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Yves\Kernel\AbstractFactory;
use Pyz\Shared\CustomerPage\CustomerPageConfig;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerAccessPermissionClientInterface;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToProductBundleClientInterface;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToQuoteClientInteface;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToSalesClientInterface;
use Pyz\Yves\CustomerPage\Form\FormFactory;
use Pyz\Yves\CustomerPage\Plugin\Provider\AccessDeniedHandler;
use Pyz\Yves\CustomerPage\Plugin\Provider\CustomerAuthenticationFailureHandler;
use Pyz\Yves\CustomerPage\Plugin\Provider\CustomerAuthenticationSuccessHandler;
use Pyz\Yves\CustomerPage\Plugin\Provider\CustomerSecurityServiceProvider;
use Pyz\Yves\CustomerPage\Plugin\Provider\CustomerUserProvider;
use Pyz\Yves\CustomerPage\Security\Customer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageConfig getConfig()
 */
class CustomerPageFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Yves\CustomerPage\Form\FormFactory
     */
    public function createCustomerFormFactory()
    {
        return new FormFactory();
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Plugin\Provider\CustomerAuthenticationSuccessHandler
     */
    public function createCustomerAuthenticationSuccessHandler()
    {
        return new CustomerAuthenticationSuccessHandler();
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Plugin\Provider\CustomerAuthenticationFailureHandler
     */
    public function createCustomerAuthenticationFailureHandler()
    {
        return new CustomerAuthenticationFailureHandler($this->getFlashMessenger());
    }

    /**
     * @return \Symfony\Component\Security\Core\User\UserProviderInterface
     */
    public function createCustomerUserProvider()
    {
        return new CustomerUserProvider();
    }

    /**
     * @param string $targetUrl
     *
     * @return \Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface
     */
    public function createAccessDeniedHandler(string $targetUrl): AccessDeniedHandlerInterface
    {
        return new AccessDeniedHandler($targetUrl);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function createSecurityUser(CustomerTransfer $customerTransfer)
    {
        return new Customer(
            $customerTransfer,
            $customerTransfer->getEmail(),
            $customerTransfer->getPassword(),
            [CustomerSecurityServiceProvider::ROLE_USER]
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\TokenInterface
     */
    public function createUsernamePasswordToken(CustomerTransfer $customerTransfer)
    {
        $user = $this->createSecurityUser($customerTransfer);

        return new UsernamePasswordToken(
            $user,
            $user->getPassword(),
            CustomerPageConfig::SECURITY_FIREWALL_NAME,
            [CustomerSecurityServiceProvider::ROLE_USER]
        );
    }

    /**
     * @param string $targetUrl
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createRedirectResponse($targetUrl)
    {
        return new RedirectResponse($targetUrl);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToSalesClientInterface
     */
    public function getSalesClient(): CustomerPageToSalesClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_SALES);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Plugin\AuthenticationHandler
     */
    public function getAuthenticationHandler()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_AUTHENTICATION_HANDLER);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToProductBundleClientInterface
     */
    public function getProductBundleClient(): CustomerPageToProductBundleClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_PRODUCT_BUNDLE);
    }

    /**
     * @return \Spryker\Shared\Kernel\Communication\Application
     */
    public function getApplication()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_APPLICATION);
    }

    /**
     * @return \Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface
     */
    public function getFlashMessenger()
    {
        return $this->getApplication()['flash_messenger'];
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Plugin\CheckoutAuthenticationHandlerPluginInterface[]
     */
    public function getCustomerAuthenticationHandlerPlugins()
    {
        return [
            $this->getLoginCheckoutAuthenticationHandlerPlugin(),
            $this->getGuestCheckoutAuthenticationHandlerPlugin(),
            $this->getRegistrationAuthenticationHandlerPlugin(),
        ];
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Plugin\LoginCheckoutAuthenticationHandlerPlugin
     */
    public function getLoginCheckoutAuthenticationHandlerPlugin()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_LOGIN_AUTHENTICATION_HANDLER);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Plugin\GuestCheckoutAuthenticationHandlerPlugin
     */
    public function getGuestCheckoutAuthenticationHandlerPlugin()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_GUEST_AUTHENTICATION_HANDLER);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Plugin\RegistrationCheckoutAuthenticationHandlerPlugin
     */
    public function getRegistrationAuthenticationHandlerPlugin()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_REGISTRATION_AUTHENTICATION_HANDLER);
    }

    /**
     * @return \Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface
     */
    public function getMessenger()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::FLASH_MESSENGER);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface
     */
    public function getCustomerClient(): CustomerPageToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerAccessPermissionClientInterface
     */
    public function getCustomerAccessPermissionClient(): CustomerPageToCustomerAccessPermissionClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_CUSTOMER_ACCESS_PERMISSION);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToQuoteClientInteface
     */
    public function getQuoteClient(): CustomerPageToQuoteClientInteface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_QUOTE);
    }

    /**
     * @return string[]
     */
    public function getCustomerOverviewWidgetPlugins(): array
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_CUSTOMER_OVERVIEW_WIDGETS);
    }

    /**
     * @return string[]
     */
    public function getCustomerOrderListWidgetPlugins(): array
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_CUSTOMER_ORDER_LIST_WIDGETS);
    }

    /**
     * @return string[]
     */
    public function getCustomerOrderViewWidgetPlugins(): array
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_CUSTOMER_ORDER_VIEW_WIDGETS);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Service\CustomerPageToUtilValidateServiceInterface
     */
    public function getUtilValidateService()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::SERVICE_UTIL_VALIDATE);
    }

    /**
     * @return string[]
     */
    public function getCustomerMenuItemWidgetPlugins(): array
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_CUSTOMER_MENU_ITEM_WIDGETS);
    }

    /**
     * @return \Pyz\Yves\CustomerPageExtension\Dependency\Plugin\PreRegistrationCustomerTransferExpanderPluginInterface[]
     */
    public function getPreRegistrationCustomerTransferExpanderPlugins(): array
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_PRE_REGISTRATION_CUSTOMER_TRANSFER_EXPANDER);
    }

    /**
     * @return \Pyz\Yves\CustomerPageExtension\Dependency\Plugin\CustomerRedirectStrategyPluginInterface[]
     */
    public function getAfterLoginCustomerRedirectPlugins(): array
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_AFTER_LOGIN_CUSTOMER_REDIRECT);
    }

    /**
     * @return \Pyz\Yves\AgentPage\Plugin\FixAgentTokenAfterCustomerAuthenticationSuccessPlugin[]
     */
    public function getAfterCustomerAuthenticationSuccessPlugins(): array
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::PLUGIN_AFTER_CUSTOMER_AUTHENTICATION_SUCCESS);
    }
}
