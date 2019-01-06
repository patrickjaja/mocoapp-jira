<?php

namespace Pyz\Zed\Log;

use Spryker\Zed\Log\Communication\Plugin\Handler\ExceptionStreamHandlerPlugin;
use Spryker\Zed\Log\Communication\Plugin\Handler\StreamHandlerPlugin;
use Spryker\Zed\Log\Communication\Plugin\Processor\EnvironmentProcessorPlugin;
use Spryker\Zed\Log\Communication\Plugin\Processor\GuzzleBodyProcessorPlugin;
use Spryker\Zed\Log\Communication\Plugin\Processor\PsrLogMessageProcessorPlugin;
use Spryker\Zed\Log\Communication\Plugin\Processor\RequestProcessorPlugin;
use Spryker\Zed\Log\Communication\Plugin\Processor\ResponseProcessorPlugin;
use Spryker\Zed\Log\Communication\Plugin\Processor\ServerProcessorPlugin;
use Spryker\Zed\Log\LogDependencyProvider as SprykerLogDependencyProvider;
use Spryker\Zed\Propel\Communication\Plugin\Log\EntityProcessorPlugin;

class LogDependencyProvider extends SprykerLogDependencyProvider
{
    /**
     * @return \Spryker\Shared\Log\Dependency\Plugin\LogHandlerPluginInterface[]
     */
    protected function getLogHandlers()
    {
        return [
            new StreamHandlerPlugin(),
            new ExceptionStreamHandlerPlugin(),
        ];
    }

    /**
     * @return \Spryker\Shared\Log\Dependency\Plugin\LogProcessorPluginInterface[]
     */
    protected function getLogProcessors()
    {
        return [
            new PsrLogMessageProcessorPlugin(),
            new EntityProcessorPlugin(),
            new EnvironmentProcessorPlugin(),
            new ServerProcessorPlugin(),
            new RequestProcessorPlugin(),
            new ResponseProcessorPlugin(),
            new GuzzleBodyProcessorPlugin(),
        ];
    }
}
