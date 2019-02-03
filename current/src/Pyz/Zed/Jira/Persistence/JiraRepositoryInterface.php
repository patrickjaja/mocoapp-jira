<?php

namespace Pyz\Zed\Jira\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\JiraConnectionTransfer;

/**
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingPersistenceFactory getFactory()
 */
interface JiraRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\JiraConnectionTransfer
     */
    public function getJiraConfigToCustomer(CustomerTransfer $customerTransfer): JiraConnectionTransfer;
}
