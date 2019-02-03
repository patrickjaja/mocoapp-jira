<?php

namespace Pyz\Zed\Jira\Persistence;

use Orm\Zed\Jira\Persistence\PyzJiraConfigQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\TimeAccounting\TimeAccountingConfig getConfig()
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingQueryContainer getQueryContainer()
 * @method \Pyz\Zed\Jira\Persistence\JiraRepositoryInterface getRepository()
 */
class JiraPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Jira\Persistence\PyzJiraConfigQuery
     */
    public function createPyzJiraConfigQuery(): PyzJiraConfigQuery
    {
        return PyzJiraConfigQuery::create();
    }
}
