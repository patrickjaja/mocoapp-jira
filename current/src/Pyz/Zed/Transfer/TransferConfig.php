<?php

namespace Pyz\Zed\Transfer;

use Spryker\Zed\Transfer\TransferConfig as SprykerTransferConfig;

class TransferConfig extends SprykerTransferConfig
{
    /**
     * @return array
     */
    public function getEntitiesSourceDirectories()
    {
        return [
            APPLICATION_SOURCE_DIR . '/Orm/Propel/*/Schema/',
        ];
    }
}
