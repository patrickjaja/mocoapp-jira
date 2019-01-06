<?php

namespace Pyz\Zed\DataImport\Business\Model\Store;

use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class StoreWriterStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        foreach ($dataSet as $storeName) {
            $storeEntity = SpyStoreQuery::create()
                ->filterByName($storeName)
                ->findOneOrCreate();

            $storeEntity->save();
        }
    }
}
