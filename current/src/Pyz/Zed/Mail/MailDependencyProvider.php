<?php

namespace Pyz\Zed\Mail;

use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRegistrationMailTypePlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRestoredPasswordConfirmationMailTypePlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRestorePasswordMailTypePlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Mail\Business\Model\Mail\MailTypeCollectionAddInterface;
use Spryker\Zed\Mail\Business\Model\Provider\MailProviderCollectionAddInterface;
use Spryker\Zed\Mail\Communication\Plugin\MailProviderPlugin;
use Spryker\Zed\Mail\MailConfig;
use Spryker\Zed\Mail\MailDependencyProvider as SprykerMailDependencyProvider;

class MailDependencyProvider extends SprykerMailDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container->extend(self::MAIL_TYPE_COLLECTION, function (MailTypeCollectionAddInterface $mailCollection) {
            $mailCollection
                ->add(new CustomerRegistrationMailTypePlugin())
                ->add(new CustomerRestorePasswordMailTypePlugin())
                ->add(new CustomerRestoredPasswordConfirmationMailTypePlugin());

            return $mailCollection;
        });

        $container->extend(self::MAIL_PROVIDER_COLLECTION, function (MailProviderCollectionAddInterface $mailProviderCollection) {
            $mailProviderCollection
                ->addProvider(new MailProviderPlugin(), [
                    MailConfig::MAIL_TYPE_ALL,
                ]);
            return $mailProviderCollection;
        });

        return $container;
    }
}
