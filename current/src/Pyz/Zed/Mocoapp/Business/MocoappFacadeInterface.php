<?php

namespace Pyz\Zed\Mocoapp\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MocoappConnectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer;

interface MocoappFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MocoappConnectionTransfer $connectionTransfer
     * @param \Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer
     *
     * @return void
     */
    public function sendTimeEntries(MocoappConnectionTransfer $connectionTransfer, MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\MocoappConnectionTransfer
     */
    public function getMocoappCustomerConfig(CustomerTransfer $customerTransfer): MocoappConnectionTransfer;
}
