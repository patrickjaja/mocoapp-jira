<?php

namespace Pyz\Zed\TimeAccounting\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PyzLastImportEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingPersistenceFactory getFactory()
 */
class TimeAccountingRepository extends AbstractRepository implements TimeAccountingRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\PyzLastImportEntityTransfer
     */
    public function getLastImport(CustomerTransfer $customerTransfer): PyzLastImportEntityTransfer
    {
        $query = $this->getFactory()
            ->createPyzLastImportQuqery()
            ->filterByFkCustomer($customerTransfer->getIdCustomer());

        return $this->buildQueryFromCriteria($query)->findOne();
    }
}
