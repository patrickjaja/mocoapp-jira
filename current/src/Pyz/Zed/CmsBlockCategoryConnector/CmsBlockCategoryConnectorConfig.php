<?php

namespace Pyz\Zed\CmsBlockCategoryConnector;

use Spryker\Zed\CmsBlockCategoryConnector\CmsBlockCategoryConnectorConfig as SprykerCmsBlockCategoryConnectorConfig;

class CmsBlockCategoryConnectorConfig extends SprykerCmsBlockCategoryConnectorConfig
{
    public const CMS_BLOCK_CATEGORY_POSITION_TOP = 'Top';
    public const CMS_BLOCK_CATEGORY_POSITION_MIDDLE = 'Middle';
    public const CMS_BLOCK_CATEGORY_POSITION_BOTTOM = 'Bottom';

    /**
     * @return array
     */
    public function getCmsBlockCategoryPositionList()
    {
        return [
            static::CMS_BLOCK_CATEGORY_POSITION_TOP,
            static::CMS_BLOCK_CATEGORY_POSITION_MIDDLE,
            static::CMS_BLOCK_CATEGORY_POSITION_BOTTOM,
        ];
    }
}
