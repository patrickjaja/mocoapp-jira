<?php

namespace Pyz\Zed\Jira\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Jira\Business\JiraFacade getFacade()
 */
class JiraConsole extends Console
{

    const COMMAND_NAME = 'jira:gettickets';
    const DESCRIPTION = 'Describe me!';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getFacade()->getTickets();

        return static::CODE_SUCCESS;
    }

}
