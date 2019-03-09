<?php

namespace Pyz\Zed\Mocoapp\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MocoappConnectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryTransfer;

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

    /**
     * @param \Generated\Shared\Transfer\MocoappConnectionTransfer $connectionTransfer
     * @param \Generated\Shared\Transfer\MocoappTimeEntryTransfer $timeEntryCollectionTransfer
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function callMoco(MocoappConnectionTransfer $connectionTransfer, MocoappTimeEntryTransfer $timeEntryCollectionTransfer): void;
}
