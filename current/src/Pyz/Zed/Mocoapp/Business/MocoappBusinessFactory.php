<?php

namespace Pyz\Zed\Mocoapp\Business;

use Pyz\Zed\Mocoapp\Business\Model\Mocoapp;
use Pyz\Zed\Mocoapp\MocoappDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Mocoapp\MocoappConfig getConfig()
 * @method \Pyz\Zed\Mocoapp\Persistence\MocoappQueryContainer getQueryContainer()
 */
class MocoappBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\Mocoapp\Business\Model\Mocoapp
     */
    public function createMocoapp()
    {
        return new Mocoapp($this->getCient());
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getCient()
    {
        return $this->getProvidedDependency(MocoappDependencyProvider::HTTP_CLIENT);
    }
}
