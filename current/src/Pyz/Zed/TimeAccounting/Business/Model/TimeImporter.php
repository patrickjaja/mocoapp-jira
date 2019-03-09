<?php


namespace Pyz\Zed\TimeAccounting\Business\Model;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\JiraResponseTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryCollectionTransfer;
use Generated\Shared\Transfer\MocoappTimeEntryTransfer;
use Orm\Zed\TimeAccounting\Persistence\PyzLastImportQuery;
use Pyz\Zed\Jira\Business\JiraFacadeInterface;
use Pyz\Zed\Mocoapp\Business\MocoappFacadeInterface;
use Pyz\Zed\TimeAccounting\Persistence\TimeAccountingRepositoryInterface;

class TimeImporter
{
//    private const JIRA_QUERY = '(summary ~ currentUser() OR description ~ currentUser() OR assignee = currentUser() OR worklogAuthor = currentUser() OR comment ~ currentUser() OR watcher = currentUser() OR text ~ currentUser() OR creator = currentUser() OR voter = currentUser()) AND updatedDate >= "%s" ORDER BY updated DESC';
    private const JIRA_QUERY = '(project = LL OR project = ESA) and updatedDate >= "%s" ORDER BY updated DESC';

    /**
     * @var \Pyz\Zed\Jira\Business\JiraFacadeInterface
     */
    private $jiraFacade;

    /**
     * @var \Pyz\Zed\Mocoapp\Business\MocoappFacadeInterface
     */
    private $mocoappFacade;

    /**
     * @var \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingRepositoryInterface
     */
    private $accountingRepository;

    /**
     * @param \Pyz\Zed\Jira\Business\JiraFacadeInterface $jiraFacade
     * @param \Pyz\Zed\Mocoapp\Business\MocoappFacadeInterface $mocoappFacade
     * @param \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingRepositoryInterface $accountingRepository
     */
    public function __construct(
        JiraFacadeInterface $jiraFacade,
        MocoappFacadeInterface $mocoappFacade,
        TimeAccountingRepositoryInterface $accountingRepository
    ) {
        //ToDo: Move to collections to have indenpendent sources and targets
        //ToDo: MOve JIRA Requests to RMQ
        $this->jiraFacade = $jiraFacade;
        $this->mocoappFacade = $mocoappFacade;
        $this->accountingRepository = $accountingRepository;
    }

    /**
     * @return void
     */
    public function import()
    {
        $customerTransfer = (new CustomerTransfer())->setIdCustomer(1);

        $lastImport = $this->accountingRepository->getLastImport($customerTransfer);
        $jiraConfig = $this->jiraFacade->getJiraCustomerConfig($customerTransfer);
        $jiraResponse = new JiraResponseTransfer();
        $jiraResponse->setLastImport($lastImport->getLastImport());
        $jiraResponse->setJql(sprintf(self::JIRA_QUERY, date('Y-m-d H:i', strtotime($lastImport->getLastImport()))));
        $jiraTicketResponse = $this->jiraFacade->getTickets($jiraConfig, $jiraResponse);
        $jiraTicketResponse->setLastImport($lastImport->getLastImport());

        $mocoConfig = $this->mocoappFacade->getMocoappCustomerConfig($customerTransfer);
        $timeCollectionTransfer = new MocoappTimeEntryCollectionTransfer();

        foreach ($jiraTicketResponse->getJiraTicketComments() as $jiraTicket) {
            $timeEntry = new MocoappTimeEntryTransfer();
            $timeEntry->setComponentIdentifier($jiraTicket->getIssueKey());
            $timeEntry->setDate(date('Y-m-d', strtotime($jiraTicket->getCreated())));
            $timeEntry->setDescription($jiraTicket->getIssueKey() . ': ' . $this->character_limiter($jiraTicket->getBody(), 200));
            $timeEntry->setHours(0.5);
            $timeEntry->setProjectId($jiraTicket->getIssueKey());
            $timeCollectionTransfer->addMocoappTimeEntries($timeEntry);
        }
        $this->mocoappFacade->sendTimeEntries($mocoConfig, $timeCollectionTransfer);

        PyzLastImportQuery::create()
            ->findOneByFkCustomer($customerTransfer->getIdCustomer())
            ->setLastImport(date('Y-m-d H:i'))
            ->save();
    }

    /**
     * @param $str
     * @param int $n
     * @param string $end_char
     *
     * @return string|string[]|null
     */
    private function character_limiter($str, $n = 500, $end_char = '&#8230;')
    {
        if (strlen($str) < $n) {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(["\r\n", "\r", "\n"], ' ', $str));

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
