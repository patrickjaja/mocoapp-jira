<?php


namespace Pyz\Zed\Mocoapp\Business\Model;

use Generated\Shared\Transfer\MocoappConnectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer;
use GuzzleHttp\Client;

class Mocoapp
{
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

    private const FALLBACK_COMPONENT = 'Sprint-Minute';

    /**
     * @param \GuzzleHttp\Client $client
     * @param \Generated\Shared\Transfer\MocoappConnectionTransfer $mocoappConnectionTransfer
     */
    public function __construct(Client $client, MocoappConnectionTransfer $mocoappConnectionTransfer)
    {
        $this->client = $client;
        $this->mocoappConnectionTransfer = $mocoappConnectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer
     *
     * @return void
     */
    public function sendTimeEntries(MocoappTimeEntryCollectionTransfer $timeEntryCollectionTransfer): void
    {
        foreach ($timeEntryCollectionTransfer->getMocoappTimeEntries() as $timeEntry) {
            $data = [
                'date' => $timeEntry->getDate(),
                'description' => $timeEntry->getDescription(),
                'project_id' => $timeEntry->getProjectId(),
                'task_id' => $this->getComponentsToProject($timeEntry->getProjectId(), $timeEntry->getComponentIdentifier()),
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
     * @param int $projectId
     * @param string $componentIdentifier
     *
     * @return int
     */
    private function getComponentsToProject(int $projectId, string $componentIdentifier): int
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
                'Authorization' => "Token token=" . $this->mocoappConnectionTransfer->getMocoappToken(),
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
