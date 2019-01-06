<?php

namespace Pyz\Zed\Mocoapp\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\Mocoapp\Business\MocoappFacade getFacade()
 * @method \Pyz\Zed\Mocoapp\Communication\MocoappCommunicationFactory getFactory()
 * @method \Pyz\Zed\Mocoapp\Persistence\MocoappQueryContainer getQueryContainer()
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
