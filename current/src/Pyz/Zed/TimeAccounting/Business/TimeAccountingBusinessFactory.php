<?php

namespace Pyz\Zed\TimeAccounting\Business;

use Pyz\Zed\Jira\Business\JiraFacadeInterface;
use Pyz\Zed\Mocoapp\Business\MocoappFacadeInterface;
use Pyz\Zed\TimeAccounting\Business\Model\TimeImporter;
use Pyz\Zed\TimeAccounting\TimeAccountingDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\TimeAccounting\TimeAccountingConfig getConfig()
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingQueryContainer getQueryContainer()
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingRepositoryInterface getRepository()
 */
class TimeAccountingBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\TimeAccounting\Business\Model\TimeImporter
     */
    public function createTimeImporter(): TimeImporter
    {
        return new TimeImporter(
            $this->getJiraClient(),
            $this->getMocoClient(),
            $this->getRepository()
        );
    }

    /**
     * @return \Pyz\Zed\Mocoapp\Business\MocoappFacadeInterface
     */
    public function getMocoClient(): MocoappFacadeInterface
    {
        return $this->getProvidedDependency(TimeAccountingDependencyProvider::MOCO_CLIENT);
    }

    /**
     * @return \Pyz\Zed\Jira\Business\JiraFacadeInterface
     */
    public function getJiraClient(): JiraFacadeInterface
    {
        return $this->getProvidedDependency(TimeAccountingDependencyProvider::JIRA_CLIENT);
    }
}
