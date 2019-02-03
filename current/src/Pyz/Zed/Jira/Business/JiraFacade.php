<?php

namespace Pyz\Zed\Jira\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\JiraConnectionTransfer;
use Generated\Shared\Transfer\JiraResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Jira\Business\JiraBusinessFactory getFactory()
 * @method \Pyz\Zed\Jira\Persistence\JiraRepositoryInterface getRepository()
 */
class JiraFacade extends AbstractFacade implements JiraFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JiraConnectionTransfer $connectionTransfer
     * @param \Generated\Shared\Transfer\JiraResponseTransfer $jiraResponseTransfer
     *
     * @return \Generated\Shared\Transfer\JiraResponseTransfer
     */
    public function getTickets(JiraConnectionTransfer $connectionTransfer, JiraResponseTransfer $jiraResponseTransfer): JiraResponseTransfer
    {
        return $this
            ->getFactory()
            ->createJiraClient($connectionTransfer)
            ->getTickets($jiraResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\JiraConnectionTransfer
     */
    public function getJiraCustomerConfig(CustomerTransfer $customerTransfer): JiraConnectionTransfer
    {
        return $this
            ->getRepository()
            ->getJiraConfigToCustomer($customerTransfer);
    }
}
