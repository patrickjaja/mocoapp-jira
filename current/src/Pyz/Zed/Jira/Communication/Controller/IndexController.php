<?php

namespace Pyz\Zed\Jira\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\Jira\Business\JiraFacade getFacade()
 * @method \Pyz\Zed\Jira\Communication\JiraCommunicationFactory getFactory()
 * @method \Pyz\Zed\Jira\Persistence\JiraQueryContainer getQueryContainer()
 */
class IndexController extends AbstractController
{

    /**
     * @return array
     */
    public function indexAction()
    {
        return $this->viewResponse([
            'test' => 'Greetings!',
        ]);
    }

}
