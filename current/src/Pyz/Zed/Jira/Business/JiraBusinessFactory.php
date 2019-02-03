<?php

namespace Pyz\Zed\Jira\Business;

use Generated\Shared\Transfer\JiraConnectionTransfer;
use Pyz\Zed\Jira\Business\Model\Jira;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Jira\Persistence\JiraRepositoryInterface getRepository()
 */
class JiraBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @param \Generated\Shared\Transfer\JiraConnectionTransfer $connectionTransfer
     *
     * @return \Pyz\Zed\Jira\Business\Model\Jira
     */
    public function createJiraClient(JiraConnectionTransfer $connectionTransfer): Jira
    {
        return new Jira($connectionTransfer);
    }
}
