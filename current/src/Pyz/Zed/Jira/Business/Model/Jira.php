<?php


namespace Pyz\Zed\Jira\Business\Model;

use JiraRestApi\Issue\IssueService;

class Jira
{
    /**
     * @var \JiraRestApi\Issue\IssueService
     */
    private $jiraClient;

    /**
     * @param \JiraRestApi\Issue\IssueService $jiraClient
     */
    public function __construct(IssueService $jiraClient)
    {
        $this->jiraClient = $jiraClient;
    }

    public function getTickets()
    {
        // Save last import date
        $lastImport="2019-01-03 06:00";
        $token='a8179427a96ebfc9c1daa3c2e7c508e8';
        $fallBackComponent = 'Sprint-Minute';

        // get comments performed by user
        $lastUpdates = "project = LL and updatedDate >= '$lastImport' ORDER BY updated DESC";
        $issues = $this->jiraClient->search($lastUpdates);
        $ticketList=[];
        foreach ($issues->getIssues() as $searchResult) {
            $ticketList[]=$searchResult->key;
        }

        $commentsToImport = [];
        foreach ($ticketList as $issueKey) {
            $comments = $this->jiraClient->getComments($issueKey);
            foreach ($comments->comments as $comment) {
                if ($lastImport < $comment->created && $comment->author->emailAddress === $this->jiraClient->getConfiguration()->getJiraUser()) {
                    $comment->issueKey=$issueKey;
                    $commentsToImport[]=$comment;
                }
            }
        }

        $projectId=944850573;
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://nexus-netsoft.mocoapp.com/api/v1/projects/$projectId/tasks", [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Authorization' => "Token token=$token",
            ]
        ]);
        $content=$res->getBody()->getContents();

        $components = \json_decode($content,true);
        foreach ($commentsToImport as $comment) {
            $fallBackId=0;
            $componentId=0;

            foreach ($components as $component) {

                if (strpos($component['name'], $fallBackComponent) !== false) {
                    $fallBackId=$component['id'];
                }

                // get componentid by checking issueKey
                if (strpos($component['name'], $comment->issueKey) !== false) {
                    $componentId=$component['id'];
                }
            }

            //Use fallback if no componentId found
            if ($componentId===0) {
                $componentId=$fallBackId;
            }

            $t = strtotime($comment->created);
            $timeentrydate= date('Y-m-d',$t);

            $data = [
                "date"=> $timeentrydate,
                "description"=> $comment->issueKey.': '.$this->character_limiter($comment->body,200),
                "project_id"=> $projectId,
                "task_id"=> $componentId,
                "hours"=> 0.5,
            ];
            $res = $client->request('POST', "https://nexus-netsoft.mocoapp.com/api/v1/activities", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                    'Authorization' => "Token token=$token",
                ],
                'body' => json_encode($data)
            ]);

            $content=$res->getBody()->getContents();

            var_dump($comment);
        }
        var_dump($res);
    }

    private function character_limiter($str, $n = 500, $end_char = '&#8230;')
    {
        if (strlen($str) < $n) {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n) {
            return $str;
        }

        $out = "";
        foreach (explode(' ', trim($str)) as $val) {
            $out .= $val . ' ';

            if (strlen($out) >= $n) {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
            }
        }
    }

}