<?php

namespace Pyz\Zed\Mocoapp\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MocoappConnectionTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Mocoapp\Persistence\MocoappPersistenceFactory getFactory()
 */
class MocoappRepository extends AbstractRepository implements MocoappRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\MocoappConnectionTransfer
     */
    public function getJiraConfigToCustomer(CustomerTransfer $customerTransfer): MocoappConnectionTransfer
    {
        $query = $this->getFactory()
            ->createPyzMocoappConfigQuery()
            ->filterByFkCustomer($customerTransfer->getIdCustomer());

        return (new MocoappConnectionTransfer())
                ->fromArray($this->buildQueryFromCriteria($query)->findOne()->toArray(), true);
    }
}
