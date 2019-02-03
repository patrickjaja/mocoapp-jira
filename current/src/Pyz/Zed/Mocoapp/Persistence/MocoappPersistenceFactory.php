<?php

namespace Pyz\Zed\Mocoapp\Persistence;

use Orm\Zed\Mocoapp\Persistence\PyzMocoappConfigQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\Mocoapp\MocoappConfig getConfig()
 * @method \Pyz\Zed\Mocoapp\Persistence\MocoappRepositoryInterface getRepository()
 */
class MocoappPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Mocoapp\Persistence\PyzMocoappConfigQuery
     */
    public function createPyzMocoappConfigQuery(): PyzMocoappConfigQuery
    {
        return PyzMocoappConfigQuery::create();
    }
}
