<?php

namespace Pyz\Zed\Jira\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Jira\Business\JiraBusinessFactory getFactory()
 */
class JiraFacade extends AbstractFacade implements JiraFacadeInterface
{

    public function getTickets() {
        return $this->getFactory()->createMocoapp()->getTickets();
    }
}
