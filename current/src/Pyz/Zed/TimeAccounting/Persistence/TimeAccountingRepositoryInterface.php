<?php

namespace Pyz\Zed\TimeAccounting\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PyzLastImportEntityTransfer;

/**
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingPersistenceFactory getFactory()
 */
interface TimeAccountingRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\PyzLastImportEntityTransfer
     */
    public function getLastImport(CustomerTransfer $customerTransfer): PyzLastImportEntityTransfer;
}
