<?php

namespace Pyz\Zed\DataImport;

use Spryker\Zed\CategoryDataImport\Communication\Plugin\CategoryDataImportPlugin;
use Spryker\Zed\DataImport\Communication\Plugin\DataImportEventBehaviorPlugin;
use Spryker\Zed\DataImport\Communication\Plugin\DataImportPublisherPlugin;
use Spryker\Zed\DataImport\DataImportDependencyProvider as SprykerDataImportDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DataImportDependencyProvider extends SprykerDataImportDependencyProvider
{
    public const FACADE_AVAILABILITY = 'availability facade';
    public const FACADE_CATEGORY = 'category facade';
    public const FACADE_STORE = 'store facade';
    public const FACADE_CURRENCY = 'currency facade';
    public const FACADE_STOCK = 'stock facade';

    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addStoreFacade($container);
        $container = $this->addCategoryFacade($container);
        $container = $this->addUtilEncodingService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container)
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return $container->getLocator()->store()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStockFacade(Container $container)
    {
        $container[static::FACADE_STOCK] = function (Container $container) {
            return $container->getLocator()->stock()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryFacade(Container $container)
    {
        $container[static::FACADE_CATEGORY] = function (Container $container) {
            return $container->getLocator()->category()->facade();
        };

        return $container;
    }

    /**
     * @return array
     */
    protected function getDataImporterPlugins(): array
    {
        return [
            //[
                //new CategoryDataImportPlugin(), DataImportConfig::IMPORT_TYPE_CATEGORY_TEMPLATE
            //],
        ];
    }

    /**
     * @return array
     */
    protected function getDataImportBeforeImportHookPlugins(): array
    {
        return [
            new DataImportEventBehaviorPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getDataImportAfterImportHookPlugins(): array
    {
        return [
            new DataImportEventBehaviorPlugin(),
            new DataImportPublisherPlugin(),
        ];
    }


    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = function (Container $container) {
            return $container->getLocator()->utilEncoding()->service();
        };

        return $container;
    }
}
