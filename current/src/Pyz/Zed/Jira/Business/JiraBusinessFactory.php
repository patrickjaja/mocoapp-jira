<?php

namespace Pyz\Zed\Jira\Business;

use JiraRestApi\Issue\IssueService;
use Pyz\Zed\Jira\Business\Model\Jira;
use Pyz\Zed\Jira\JiraDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Jira\JiraConfig getConfig()
 * @method \Pyz\Zed\Jira\Persistence\JiraQueryContainer getQueryContainer()
 */
class JiraBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\Jira\Business\Model\Jira
     */
    public function createMocoapp()
    {
        return new Jira($this->getJiraCient());
    }

    /**
     * @return IssueService
     */
    public function getJiraCient()
    {
        return $this->getProvidedDependency(JiraDependencyProvider::JIRA_CLIENT);
    }
}
