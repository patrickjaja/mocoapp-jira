<?php

namespace Pyz\Zed\Mocoapp\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\JiraConnectionTransfer;
use Generated\Shared\Transfer\MocoappConnectionTransfer;

/**
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingPersistenceFactory getFactory()
 */
interface MocoappRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\MocoappConnectionTransfer
     */
    public function getJiraConfigToCustomer(CustomerTransfer $customerTransfer): MocoappConnectionTransfer;
}
