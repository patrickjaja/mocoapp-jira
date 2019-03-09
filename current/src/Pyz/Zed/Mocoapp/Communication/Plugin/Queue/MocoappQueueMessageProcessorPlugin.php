<?php


namespace Pyz\Zed\Mocoapp\Communication\Plugin\Queue;

use Generated\Shared\Transfer\MocoappConnectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Queue\Dependency\Plugin\QueueMessageProcessorPluginInterface;

/**
 * @method \Pyz\Zed\Mocoapp\Business\MocoappFacadeInterface getFacade()
 * @method \Pyz\Zed\Mocoapp\Communication\MocoappCommunicationFactory getFactory()
 * @method \Pyz\Zed\Mocoapp\MocoappConfig getConfig()
 */
class MocoappQueueMessageProcessorPlugin extends AbstractPlugin implements QueueMessageProcessorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QueueReceiveMessageTransfer[] $queueMessageTransfers
     *
     * @return \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]|mixed
     */
    public function processMessages(array $queueMessageTransfers)
    {
        foreach ($queueMessageTransfers as $queueMessageTransfer) {
            $mocoDetails = json_decode($queueMessageTransfer->getQueueMessage()->getBody(), true);
            $mocoappTimeEntryTransfer = (new MocoappTimeEntryTransfer())->fromArray($mocoDetails[0]);
            $mocoappConnectionTransfer = (new MocoappConnectionTransfer())->fromArray($mocoDetails[1]);
            $this->getFacade()->callMoco($mocoappConnectionTransfer, $mocoappTimeEntryTransfer);
            $queueMessageTransfer->setAcknowledge(true);
        }


        return $queueMessageTransfers;
    }

    /**
     * @return int
     */
    public function getChunkSize()
    {
        return '5';
    }
}