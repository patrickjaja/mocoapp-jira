<?php

namespace Pyz\Zed\TimeAccounting\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\TimeAccounting\Business\TimeAccountingBusinessFactory getFactory()
 * @method \Pyz\Zed\TimeAccounting\Persistence\TimeAccountingRepositoryInterface getRepository()
 */
class TimeAccountingFacade extends AbstractFacade implements TimeAccountingFacadeInterface
{
    /**
     * @return void
     */
    public function import(): void
    {
        $this->getFactory()->createTimeImporter()->import();
    }
}
