<?php

namespace Pyz\Zed\Mocoapp\Business;

use Generated\Shared\Transfer\MocoappConnectionTransfer;
use GuzzleHttp\Client;
use Pyz\Zed\Mocoapp\Business\Model\Mocoapp;
use Pyz\Zed\Mocoapp\MocoappDependencyProvider;
use Spryker\Client\Queue\QueueClient;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Mocoapp\MocoappConfig getConfig()
 * @method \Pyz\Zed\Mocoapp\Persistence\MocoappQueryContainer getQueryContainer()
 * @method \Pyz\Zed\Mocoapp\Persistence\MocoappRepositoryInterface getRepository()
 */
class MocoappBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @param \Generated\Shared\Transfer\MocoappConnectionTransfer $connectionTransfer
     *
     * @return \Pyz\Zed\Mocoapp\Business\Model\Mocoapp
     */
    public function createMocoapp(MocoappConnectionTransfer $connectionTransfer): Mocoapp
    {
        return new Mocoapp($this->getHttpCient(), $connectionTransfer, $this->getQueueCient());
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpCient(): Client
    {
        return $this->getProvidedDependency(MocoappDependencyProvider::HTTP_CLIENT);
    }

    /**
     * @return \Spryker\Client\Queue\QueueClient
     */
    public function getQueueCient(): QueueClient
    {
        return $this->getProvidedDependency(MocoappDependencyProvider::QUEUE_CLIENT);
    }
}
