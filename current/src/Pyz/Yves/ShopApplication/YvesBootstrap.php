<?php

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\CustomerPage\Plugin\Provider\CustomerSecurityServiceProvider;
use Pyz\Yves\CustomerPage\Plugin\Provider\CustomerTwigFunctionServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Spryker\Service\UtilDateTime\ServiceProvider\DateTimeFormatterServiceProvider;
use Spryker\Shared\Application\ServiceProvider\FormFactoryServiceProvider;
use Spryker\Shared\Application\ServiceProvider\HeadersSecurityServiceProvider;
use Spryker\Shared\Application\ServiceProvider\RoutingServiceProvider;
use Spryker\Shared\Application\ServiceProvider\UrlGeneratorServiceProvider;
use Spryker\Shared\Config\Environment;
use Spryker\Yves\Application\Plugin\Provider\CookieServiceProvider;
use Spryker\Yves\Application\Plugin\Provider\YvesHstsServiceProvider;
use Spryker\Yves\Application\Plugin\ServiceProvider\AssertUrlConfigurationServiceProvider;
use Spryker\Yves\Application\Plugin\ServiceProvider\SslServiceProvider;
use Spryker\Yves\CmsContentWidget\Plugin\CmsContentWidgetServiceProvider;
use Spryker\Yves\Messenger\Plugin\Provider\FlashMessengerServiceProvider;
use Spryker\Yves\Monitoring\Plugin\ServiceProvider\MonitoringRequestTransactionServiceProvider;
use Spryker\Yves\Session\Plugin\ServiceProvider\SessionServiceProvider as SprykerSessionServiceProvider;
use Spryker\Yves\Storage\Plugin\Provider\StorageCacheServiceProvider;
use Spryker\Yves\Twig\Plugin\ServiceProvider\TwigServiceProvider as SprykerTwigServiceProvider;
use Spryker\Yves\ZedRequest\Plugin\ServiceProvider\ZedRequestHeaderServiceProvider;
use SprykerShop\Yves\CmsBlockWidget\Plugin\Provider\CmsBlockTwigFunctionServiceProvider;
use SprykerShop\Yves\CmsPage\Plugin\Provider\CmsTwigFunctionServiceProvider;
use SprykerShop\Yves\ErrorPage\Plugin\Provider\ErrorPageControllerProvider;
use SprykerShop\Yves\ErrorPage\Plugin\Provider\ErrorPageServiceProvider;
use SprykerShop\Yves\HomePage\Plugin\Provider\HomePageControllerProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AutoloaderCacheServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\ShopApplicationServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\ShopControllerEventServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\ShopTwigServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\WidgetServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\WidgetTagServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\YvesExceptionServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\YvesSecurityServiceProvider;
use SprykerShop\Yves\ShopApplication\YvesBootstrap as SprykerYvesBootstrap;
use SprykerShop\Yves\ShopPermission\Plugin\Provider\ShopPermissionServiceProvider;
use SprykerShop\Yves\ShopRouter\Plugin\Router\SilexRouter;
use SprykerShop\Yves\ShopRouter\Plugin\Router\StorageRouter;
use SprykerShop\Yves\ShopTranslator\Plugin\Provider\TranslationServiceProvider;
use SprykerShop\Yves\ShopUi\Plugin\Provider\ShopUiTwigServiceProvider;
use SprykerShop\Yves\WebProfilerWidget\Plugin\ServiceProvider\WebProfilerWidgetServiceProvider;

class YvesBootstrap extends SprykerYvesBootstrap
{
    /**
     * @return void
     */
    protected function registerServiceProviders()
    {
        if (Environment::isDevelopment()) {
            $this->application->register(new AssertUrlConfigurationServiceProvider());
        }

        $this->application->register(new SslServiceProvider());
        $this->application->register(new StorageCacheServiceProvider());
        $this->application->register(new ZedRequestHeaderServiceProvider());

        $this->application->register(new ShopControllerEventServiceProvider());
        $this->application->register(new ShopTwigServiceProvider());
        $this->application->register(new SprykerTwigServiceProvider());
        $this->application->register(new WidgetServiceProvider());
        $this->application->register(new WidgetTagServiceProvider());
        $this->application->register(new ShopApplicationServiceProvider());
        $this->application->register(new DateTimeFormatterServiceProvider());
        $this->application->register(new SessionServiceProvider());
        $this->application->register(new SprykerSessionServiceProvider());
        $this->application->register(new SecurityServiceProvider());
        $this->application->register(new CustomerSecurityServiceProvider());
        $this->application->register(new CustomerTwigFunctionServiceProvider());
        $this->application->register(new YvesSecurityServiceProvider());
        $this->application->register(new YvesExceptionServiceProvider());
        $this->application->register(new ErrorPageServiceProvider());
        $this->application->register(new MonitoringRequestTransactionServiceProvider());
        $this->application->register(new CookieServiceProvider());
        $this->application->register(new UrlGeneratorServiceProvider());
        $this->application->register(new ServiceControllerServiceProvider());
        $this->application->register(new RememberMeServiceProvider());
        $this->application->register(new RoutingServiceProvider());
        $this->application->register(new TranslationServiceProvider());
        $this->application->register(new ValidatorServiceProvider());
        $this->application->register(new FormServiceProvider());
        $this->application->register(new HttpFragmentServiceProvider());
        $this->application->register(new FlashMessengerServiceProvider());
        $this->application->register(new HeadersSecurityServiceProvider());
        $this->application->register(new WebProfilerWidgetServiceProvider());
        $this->application->register(new AutoloaderCacheServiceProvider());
        $this->application->register(new YvesHstsServiceProvider());
        $this->application->register(new FormFactoryServiceProvider());
        $this->application->register(new CmsContentWidgetServiceProvider());
        $this->application->register(new CmsTwigFunctionServiceProvider());
        $this->application->register(new CmsBlockTwigFunctionServiceProvider());
        $this->application->register(new ShopUiTwigServiceProvider());
        $this->application->register(new ShopPermissionServiceProvider());
    }

    /**
     * @return void
     */
    protected function registerRouters()
    {
        $this->application->addRouter((new StorageRouter())->setSsl(false));
        $this->application->addRouter(new SilexRouter());
    }

    /**
     * @return void
     */
    protected function registerControllerProviders()
    {
        $isSsl = $this->config->isSslEnabled();

        $controllerProviders = $this->getControllerProviderStack($isSsl);

        foreach ($controllerProviders as $controllerProvider) {
            $this->application->mount($controllerProvider->getUrlPrefix(), $controllerProvider);
        }
    }

    /**
     * @param bool|null $isSsl
     *
     * @return \SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider[]
     */
    protected function getControllerProviderStack($isSsl)
    {
        return [
            new ErrorPageControllerProvider($isSsl),
            new HomePageControllerProvider($isSsl),
        ];
    }
}
