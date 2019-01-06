<?php

namespace Pyz\Zed\Messenger;

use Spryker\Zed\Glossary\Communication\Plugin\TranslationPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Messenger\MessengerDependencyProvider as SprykerMessengerDependencyProvider;

class MessengerDependencyProvider extends SprykerMessengerDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTranslationPlugin(Container $container)
    {
        $container[static::PLUGIN_TRANSLATION] = function (Container $container) {
            return new TranslationPlugin();
        };

        return $container;
    }
}
