<?php

namespace Pyz\Zed\Cms;

use Spryker\Zed\Cms\CmsConfig as SprykerCmsConfig;

class CmsConfig extends SprykerCmsConfig
{
    /**
     * @return bool
     */
    public function appendPrefixToCmsPageUrl()
    {
        return true;
    }
}
