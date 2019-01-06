<?php

namespace Pyz\Zed\Event;

use Spryker\Zed\CategoryPageSearch\Communication\Plugin\Event\Subscriber\CategoryPageSearchEventSubscriber;
use Spryker\Zed\CategoryStorage\Communication\Plugin\Event\Subscriber\CategoryStorageEventSubscriber;
use Spryker\Zed\CmsBlockCategoryStorage\Communication\Plugin\Event\Subscriber\CmsBlockCategoryStorageEventSubscriber;
use Spryker\Zed\CmsBlockStorage\Communication\Plugin\Event\Subscriber\CmsBlockStorageEventSubscriber;
use Spryker\Zed\CmsPageSearch\Communication\Plugin\Event\Subscriber\CmsPageSearchEventSubscriber;
use Spryker\Zed\CmsStorage\Communication\Plugin\Event\Subscriber\CmsStorageEventSubscriber;
use Spryker\Zed\CustomerAccessStorage\Communication\Plugin\Event\Subscriber\CustomerAccessStorageEventSubscriber;
use Spryker\Zed\Event\EventDependencyProvider as SprykerEventDependencyProvider;
use Spryker\Zed\GlossaryStorage\Communication\Plugin\Event\Subscriber\GlossaryStorageEventSubscriber;
use Spryker\Zed\NavigationStorage\Communication\Plugin\Event\Subscriber\NavigationStorageEventSubscriber;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\Subscriber\UrlStorageEventSubscriber;

class EventDependencyProvider extends SprykerEventDependencyProvider
{
    /**
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getEventListenerCollection()
    {
        return parent::getEventListenerCollection();
    }

    /**
     * @return \Spryker\Zed\Event\Dependency\EventSubscriberCollectionInterface
     */
    public function getEventSubscriberCollection()
    {
        $eventSubscriberCollection = parent::getEventSubscriberCollection();

        /**
         * Storage Events
         */
        $eventSubscriberCollection->add(new GlossaryStorageEventSubscriber());
        $eventSubscriberCollection->add(new UrlStorageEventSubscriber());
        $eventSubscriberCollection->add(new CategoryStorageEventSubscriber());
        $eventSubscriberCollection->add(new CmsStorageEventSubscriber());
        $eventSubscriberCollection->add(new CmsBlockStorageEventSubscriber());
        $eventSubscriberCollection->add(new CmsBlockCategoryStorageEventSubscriber());
        $eventSubscriberCollection->add(new NavigationStorageEventSubscriber());
        $eventSubscriberCollection->add(new CustomerAccessStorageEventSubscriber());

        /**
         * Search Events
         */
        $eventSubscriberCollection->add(new CategoryPageSearchEventSubscriber());
        $eventSubscriberCollection->add(new CmsPageSearchEventSubscriber());

        return $eventSubscriberCollection;
    }
}
