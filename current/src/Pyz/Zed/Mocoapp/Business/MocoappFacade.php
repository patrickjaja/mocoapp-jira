<?php

namespace Pyz\Zed\Mocoapp\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MocoappConnectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Mocoapp\Business\MocoappBusinessFactory getFactory()
 * @method \Pyz\Zed\Mocoapp\Persistence\MocoappRepositoryInterface getRepository()
 */
class MocoappFacade extends AbstractFacade implements MocoappFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MocoappConnectionTransfer $connectionTransfer
     * @param \Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer
     *
     * @return void
     */
    public function sendTimeEntries(
        MocoappConnectionTransfer $connectionTransfer,
        MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer
    ): void {
        $this
            ->getFactory()
            ->createMocoapp($connectionTransfer)
            ->sendTimeEntries($timeEntryCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\MocoappConnectionTransfer
     */
    public function getMocoappCustomerConfig(CustomerTransfer $customerTransfer): MocoappConnectionTransfer
    {
        return $this
            ->getRepository()
            ->getJiraConfigToCustomer($customerTransfer);
    }
}
