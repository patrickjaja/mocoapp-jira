<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Form;

use Closure;
use Generated\Shared\Transfer\AddressTransfer;
use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageConfig getConfig()
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class CheckoutAddressCollectionForm extends AbstractType
{
    public const FIELD_SHIPPING_ADDRESS = 'shippingAddress';
    public const FIELD_BILLING_ADDRESS = 'billingAddress';
    public const FIELD_BILLING_SAME_AS_SHIPPING = 'billingSameAsShipping';
    public const FIELD_IS_ADDRESS_SAVING_SKIPPED = 'isAddressSavingSkipped';

    public const OPTION_ADDRESS_CHOICES = 'address_choices';
    public const OPTION_COUNTRY_CHOICES = 'country_choices';

    public const GROUP_SHIPPING_ADDRESS = self::FIELD_SHIPPING_ADDRESS;
    public const GROUP_BILLING_ADDRESS = self::FIELD_BILLING_ADDRESS;

    protected const GLOSSARY_KEY_SAVE_NEW_ADDRESS = 'customer.address.save_new_address';

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'addressesForm';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $resolver */
        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form) {
                $validationGroups = [Constraint::DEFAULT_GROUP, self::GROUP_SHIPPING_ADDRESS];

                if (!$form->get(self::FIELD_BILLING_SAME_AS_SHIPPING)->getData()) {
                    $validationGroups[] = self::GROUP_BILLING_ADDRESS;
                }

                return $validationGroups;
            },
            self::OPTION_ADDRESS_CHOICES => [],
        ]);

        $resolver->setDefined(self::OPTION_ADDRESS_CHOICES);
        $resolver->setRequired(self::OPTION_COUNTRY_CHOICES);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addShippingAddressSubForm($builder, $options)
            ->addSameAsShipmentCheckbox($builder)
            ->addBillingAddressSubForm($builder, $options)
            ->addIsAddressSavingSkippedField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addShippingAddressSubForm(FormBuilderInterface $builder, array $options)
    {
        $options = [
            'data_class' => AddressTransfer::class,
            'required' => true,
            'validation_groups' => function (FormInterface $form) {
                if (!$form->has(CheckoutAddressForm::FIELD_ID_CUSTOMER_ADDRESS) || !$form->get(CheckoutAddressForm::FIELD_ID_CUSTOMER_ADDRESS)->getData()) {
                    return [self::GROUP_SHIPPING_ADDRESS];
                }

                return false;
            },
            CheckoutAddressForm::OPTION_VALIDATION_GROUP => self::GROUP_SHIPPING_ADDRESS,
            CheckoutAddressForm::OPTION_ADDRESS_CHOICES => $options[self::OPTION_ADDRESS_CHOICES],
            CheckoutAddressForm::OPTION_COUNTRY_CHOICES => $options[self::OPTION_COUNTRY_CHOICES],
        ];

        $builder->add(self::FIELD_SHIPPING_ADDRESS, CheckoutAddressForm::class, $options);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addSameAsShipmentCheckbox(FormBuilderInterface $builder)
    {
        $builder->add(
            self::FIELD_BILLING_SAME_AS_SHIPPING,
            CheckboxType::class,
            [
                'required' => false,
            ]
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addBillingAddressSubForm(FormBuilderInterface $builder, array $options)
    {
        $options = [
            'data_class' => AddressTransfer::class,
            'validation_groups' => function (FormInterface $form) {
                if ($form->getParent()->get(self::FIELD_BILLING_SAME_AS_SHIPPING)->getData()) {
                    return false;
                }

                if (!$form->has(CheckoutAddressForm::FIELD_ID_CUSTOMER_ADDRESS) || !$form->get(CheckoutAddressForm::FIELD_ID_CUSTOMER_ADDRESS)->getData()) {
                    return [self::GROUP_BILLING_ADDRESS];
                }

                return false;
            },
            'required' => true,
            CheckoutAddressForm::OPTION_VALIDATION_GROUP => self::GROUP_BILLING_ADDRESS,
            CheckoutAddressForm::OPTION_ADDRESS_CHOICES => $options[self::OPTION_ADDRESS_CHOICES],
            CheckoutAddressForm::OPTION_COUNTRY_CHOICES => $options[self::OPTION_COUNTRY_CHOICES],
        ];

        $builder->add(self::FIELD_BILLING_ADDRESS, CheckoutAddressForm::class, $options);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addIsAddressSavingSkippedField(FormBuilderInterface $builder): self
    {
        $isLoggedIn = $this->getFactory()
            ->getCustomerClient()
            ->isLoggedIn();

        if (!$isLoggedIn) {
            return $this;
        }

        $builder->add(static::FIELD_IS_ADDRESS_SAVING_SKIPPED, CheckboxType::class, [
            'label' => static::GLOSSARY_KEY_SAVE_NEW_ADDRESS,
            'required' => false,
        ]);

        $callbackTransformer = new CallbackTransformer(
            $this->getInvertedBooleanValueCallbackTransformer(),
            $this->getInvertedBooleanValueCallbackTransformer()
        );

        $builder->get(static::FIELD_IS_ADDRESS_SAVING_SKIPPED)
            ->addModelTransformer($callbackTransformer);

        return $this;
    }

    /**
     * @return \Closure
     */
    protected function getInvertedBooleanValueCallbackTransformer(): Closure
    {
        return function (?bool $value): bool {
            if ($value === null) {
                return true;
            }

            return !$value;
        };
    }
}
