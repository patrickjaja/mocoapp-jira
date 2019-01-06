<?php

namespace Pyz\Zed\EventBehavior;

use Spryker\Zed\CmsBlockStorage\Communication\Plugin\Event\CmsBlockEventResourceQueryContainerPlugin;
use Spryker\Zed\CmsPageSearch\Communication\Plugin\Event\CmsPageEventResourceQueryContainerPlugin;
use Spryker\Zed\CmsStorage\Communication\Plugin\Event\CmsEventResourceQueryContainerPlugin;
use Spryker\Zed\EventBehavior\EventBehaviorDependencyProvider as SprykerEventBehaviorDependencyProvider;
use Spryker\Zed\GlossaryStorage\Communication\Plugin\Event\GlossaryEventResourceQueryContainerPlugin;
use Spryker\Zed\NavigationStorage\Communication\Plugin\Event\NavigationEventResourceQueryContainerPlugin;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\RedirectEventResourceQueryContainerPlugin;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\UrlEventResourceQueryContainerPlugin;

class EventBehaviorDependencyProvider extends SprykerEventBehaviorDependencyProvider
{
    /**
     * @return \Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourcePluginInterface[]
     */
    protected function getEventTriggerResourcePlugins()
    {
        return [
            new CmsPageEventResourceQueryContainerPlugin(),
            new CmsBlockEventResourceQueryContainerPlugin(),
            new CmsEventResourceQueryContainerPlugin(),
            new GlossaryEventResourceQueryContainerPlugin(),
            new NavigationEventResourceQueryContainerPlugin(),
            new UrlEventResourceQueryContainerPlugin(),
            new RedirectEventResourceQueryContainerPlugin(),
        ];
    }
}
