<?php


namespace Pyz\Zed\Jira\Business\Model;

use Generated\Shared\Transfer\JiraConnectionTransfer;
use Generated\Shared\Transfer\JiraResponseTransfer;
use Generated\Shared\Transfer\JiraTicketCommentTransfer;
use JiraRestApi\Configuration\ArrayConfiguration;
use JiraRestApi\Issue\IssueService;

class Jira
{
    /**
     * @var \JiraRestApi\Issue\IssueService
     */
    private $jiraClient;

    /**
     * @param \Generated\Shared\Transfer\JiraConnectionTransfer $connectionTransfer
     */
    public function __construct(JiraConnectionTransfer $connectionTransfer)
    {
        $this->jiraClient = new IssueService(new ArrayConfiguration(
            $connectionTransfer->toArray(true, true)
        ));
    }

    /**
     * @param \Generated\Shared\Transfer\JiraResponseTransfer $jiraResponseTransfer
     *
     * @return \Generated\Shared\Transfer\JiraResponseTransfer
     */
    public function getTickets(JiraResponseTransfer $jiraResponseTransfer): JiraResponseTransfer
    {
        $issues = $this->jiraClient->search($jiraResponseTransfer->getJql());
        $ticketList = [];
        foreach ($issues->getIssues() as $searchResult) {
            $ticketList[] = $searchResult->key;
        }

        foreach ($ticketList as $issueKey) {
            $comments = $this->jiraClient->getComments($issueKey);
            foreach ($comments->comments as $comment) {
                if ($jiraResponseTransfer->getLastImport() < $comment->created && $comment->author->emailAddress === $this->jiraClient->getConfiguration()->getJiraUser()) {
                    $comment->issueKey = $issueKey;
                    $jiraResponseTransfer->addJiraTicketComments(
                        (new JiraTicketCommentTransfer())->fromArray(get_object_vars($comment), true)
                    );
                }
            }
        }
        return $jiraResponseTransfer;
    }
}
