<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Form;

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;
use Pyz\Yves\CustomerPage\CustomerPageDependencyProvider;
use Pyz\Yves\CustomerPage\Form\DataProvider\AddressFormDataProvider;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageConfig getConfig()
 */
class FormFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\Form\FormFactory
     */
    public function getFormFactory()
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY);
    }

    /**
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getAddressForm(array $formOptions = [])
    {
        return $this->getFormFactory()->create(AddressForm::class, null, $formOptions);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Form\DataProvider\AddressFormDataProvider
     */
    public function createAddressFormDataProvider()
    {
        return new AddressFormDataProvider($this->getCustomerClient(), $this->getStore());
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getRegisterForm()
    {
        return $this->getFormFactory()->create(RegisterForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getLoginForm()
    {
        return $this->getFormFactory()->create(LoginForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getForgottenPasswordForm()
    {
        return $this->getFormFactory()->create(ForgottenPasswordForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getProfileForm()
    {
        return $this->getFormFactory()->create(ProfileForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getFormRestorePassword()
    {
        return $this->getFormFactory()->create(RestorePasswordForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getPasswordForm()
    {
        return $this->getFormFactory()->create(PasswordForm::class);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface
     */
    public function getCustomerClient()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStore()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::STORE);
    }
}
