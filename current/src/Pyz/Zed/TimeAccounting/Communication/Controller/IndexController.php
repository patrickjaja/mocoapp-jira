<?php

namespace Pyz\Zed\TimeAccounting\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\TimeAccounting\Business\TimeAccountingFacade getFacade()
 * @method \Pyz\Zed\TimeAccounting\Communication\TimeAccountingCommunicationFactory getFactory()
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingQueryContainer getQueryContainer()
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
