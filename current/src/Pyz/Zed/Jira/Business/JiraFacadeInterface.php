<?php

namespace Pyz\Zed\Jira\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\JiraConnectionTransfer;
use Generated\Shared\Transfer\JiraResponseTransfer;

interface JiraFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JiraConnectionTransfer $connectionTransfer
     * @param \Generated\Shared\Transfer\JiraResponseTransfer $jiraResponseTransfer
     *
     * @return \Generated\Shared\Transfer\JiraResponseTransfer
     */
    public function getTickets(JiraConnectionTransfer $connectionTransfer, JiraResponseTransfer $jiraResponseTransfer): JiraResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\JiraConnectionTransfer
     */
    public function getJiraCustomerConfig(CustomerTransfer $customerTransfer): JiraConnectionTransfer;
}
