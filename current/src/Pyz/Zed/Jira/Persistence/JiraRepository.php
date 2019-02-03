<?php

namespace Pyz\Zed\Jira\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\JiraConnectionTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Jira\Persistence\JiraPersistenceFactory getFactory()
 */
class JiraRepository extends AbstractRepository implements JiraRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\JiraConnectionTransfer
     */
    public function getJiraConfigToCustomer(CustomerTransfer $customerTransfer): JiraConnectionTransfer
    {
        $query = $this->getFactory()
            ->createPyzJiraConfigQuery()
            ->filterByFkCustomer($customerTransfer->getIdCustomer());

        return (new JiraConnectionTransfer())
                ->fromArray($this->buildQueryFromCriteria($query)->findOne()->toArray(), true);
    }
}
