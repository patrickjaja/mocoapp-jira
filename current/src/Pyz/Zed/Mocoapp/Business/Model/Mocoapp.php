<?php


namespace Pyz\Zed\Mocoapp\Business\Model;

use Generated\Shared\Transfer\MocoappConnectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryTransfer;
use Generated\Shared\Transfer\QueueSendMessageTransfer;
use GuzzleHttp\Client;
use Orm\Zed\Mocoapp\Persistence\PyzMocoappProjectMappingQuery;
use Pyz\Shared\Mocoapp\MocoappConstants;
use Spryker\Client\Queue\QueueClient;
use Spryker\Client\Queue\QueueClientInterface;

class Mocoapp
{
    private const FALLBACK_COMPONENT = 'Sprint-Minute';
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var \Generated\Shared\Transfer\MocoappConnectionTransfer
     */
    private $mocoappConnectionTransfer;

    /**
     * @var array
     */
    private $mocoComponents = [];

    /**
     * @var \Spryker\Client\Queue\QueueClientInterface
     */
    private $queueClient;

    /**
     * @param \GuzzleHttp\Client $client
     * @param \Generated\Shared\Transfer\MocoappConnectionTransfer $mocoappConnectionTransfer
     * @param \Spryker\Client\Queue\QueueClientInterface $queueClient
     */
    public function __construct(Client $client, MocoappConnectionTransfer $mocoappConnectionTransfer, QueueClientInterface $queueClient)
    {
        $this->client = $client;
        $this->mocoappConnectionTransfer = $mocoappConnectionTransfer;
        $this->queueClient = $queueClient;
    }

    /**
     * @param \Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer
     *
     * @return void
     */
    public function sendTimeEntries(MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer): void
    {
        $msgs=[];

        foreach ($timeEntryCollectionTransfer->getMocoappTimeEntries() as $timeEntry) {
            $queueMessageTransfer = new QueueSendMessageTransfer();
            $queueMessageTransfer->setBody(\json_encode([$timeEntry->toArray(),$this->mocoappConnectionTransfer->toArray()]));
            $msgs[]=$queueMessageTransfer;
        }
        $this->queueClient->sendMessages(MocoappConstants::MOCOAPP_QUEUE,$msgs);
    }

    /**
     * @param \Generated\Shared\Transfer\MocoappTimeEntryTransfer $timeEntry
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function callMoco(MocoappTimeEntryTransfer $timeEntry) {
        $projectMapping = $this->getMocoappProjectMapping();
        $projectKey = explode('-', $timeEntry->getProjectId())[0];
        if (isset($projectMapping[$projectKey])) {
            $projectId = $projectMapping[$projectKey];
            $data = [
                'date' => $timeEntry->getDate(),
                'description' => $timeEntry->getDescription(),
                'project_id' => $projectId,
                'task_id' => $this->getComponentIdToProject($projectId, $timeEntry->getComponentIdentifier()),
                'hours' => $timeEntry->getHours(),
            ];
            $res = $this->client->request('POST', $this->mocoappConnectionTransfer->getMocoappHost() . "/api/v1/activities", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                    'Authorization' => 'Token token=' . $this->mocoappConnectionTransfer->getMocoappToken(),
                ],
                'body' => json_encode($data),
            ]);

            //ToDo: Check Mocoresponse
            $content = $res->getBody()->getContents();
        }
    }

    /**
     * @return array
     */
    private function getMocoappProjectMapping(): array
    {
        $projectMap = [];
        foreach (PyzMocoappProjectMappingQuery::create()->find() as $projectMapping) {
            $projectMap[$projectMapping->getProjectIdentifier()] = $projectMapping->getMocoappIdProject();
        }
        return $projectMap;
    }

    /**
     * @param int $projectId
     * @param string $componentIdentifier
     *
     * @return int
     */
    private function getComponentIdToProject(int $projectId, string $componentIdentifier): int
    {
        $components = $this->loadMococomponentsToProject($projectId);

        $fallBackId = 0;
        $componentId = 0;

        foreach ($components as $component) {
            if (strpos($component['name'], self::FALLBACK_COMPONENT) !== false) {
                $fallBackId = $component['id'];
            }

            // get componentid by checking issueKey
            if (strpos($component['name'], $componentIdentifier) !== false) {
                $componentId = $component['id'];
            }
        }

        //Use fallback if no componentId found
        if ($componentId === 0) {
            //ToDo: Throw exception if $fallBackId === 0 (no fallback found in project)
            $componentId = $fallBackId;
        }
        return $componentId;
    }

    /**
     * @param int $projectId
     *
     * @return array
     */
    private function loadMococomponentsToProject(int $projectId): array
    {
        $res = $this->client->request('GET', $this->mocoappConnectionTransfer->getMocoappHost() . "/api/v1/projects/$projectId/tasks", [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Authorization' => 'Token token=' . $this->mocoappConnectionTransfer->getMocoappToken(),
            ],
        ]);

        if (!isset($this->mocoComponents[$projectId])) {
            $content = json_decode($res->getBody()->getContents(), true);
            $this->mocoComponents[$projectId] = $content;
        } else {
            $content = $this->mocoComponents[$projectId];
        }
        return $content;
    }
}
