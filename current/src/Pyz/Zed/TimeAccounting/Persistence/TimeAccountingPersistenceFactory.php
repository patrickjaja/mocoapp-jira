<?php

namespace Pyz\Zed\TimeAccounting\Persistence;

use Orm\Zed\TimeAccounting\Persistence\PyzLastImportQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\TimeAccounting\TimeAccountingConfig getConfig()
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingQueryContainer getQueryContainer()
 */
class TimeAccountingPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\TimeAccounting\Persistence\PyzLastImportQuery
     */
    public function createPyzLastImportQuqery(): PyzLastImportQuery
    {
        return PyzLastImportQuery::create();
    }
}
