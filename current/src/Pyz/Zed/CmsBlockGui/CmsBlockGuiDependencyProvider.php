<?php

namespace Pyz\Zed\CmsBlockGui;

use Spryker\Zed\CmsBlockCategoryConnector\Communication\Plugin\CmsBlockCategoryFormPlugin;
use Spryker\Zed\CmsBlockCategoryConnector\Communication\Plugin\CmsBlockCategoryListViewPlugin;
use Spryker\Zed\CmsBlockGui\CmsBlockGuiDependencyProvider as CmsBlockGuiCmsBlockGuiDependencyProvider;
use Spryker\Zed\CmsBlockProductConnector\Communication\Plugin\CmsBlockProductAbstractFormPlugin;
use Spryker\Zed\CmsBlockProductConnector\Communication\Plugin\CmsBlockProductAbstractListViewPlugin;
use Spryker\Zed\Store\Communication\Plugin\Form\StoreRelationToggleFormTypePlugin;

class CmsBlockGuiDependencyProvider extends CmsBlockGuiCmsBlockGuiDependencyProvider
{
    /**
     * @return array
     */
    protected function getCmsBlockFormPlugins()
    {
        $plugins = parent::getCmsBlockFormPlugins();
        $plugins = array_merge($plugins, [
            new CmsBlockCategoryFormPlugin(),
        ]);

        return $plugins;
    }

    /**
     * @return array
     */
    protected function getCmsBlockViewPlugins()
    {
        return array_merge(parent::getCmsBlockViewPlugins(), [
            new CmsBlockCategoryListViewPlugin(),
        ]);
    }

    /**
     * @return \Spryker\Zed\Kernel\Communication\Form\FormTypeInterface
     */
    protected function getStoreRelationFormTypePlugin()
    {
        return new StoreRelationToggleFormTypePlugin();
    }
}
