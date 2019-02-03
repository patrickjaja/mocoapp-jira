<?php

namespace Pyz\Zed\Console;

use Pyz\Zed\DataImport\DataImportConfig;
use Pyz\Zed\TimeAccounting\Communication\Console\TimeAccountingConsole;
use Silex\Provider\TwigServiceProvider as SilexTwigServiceProvider;
use Spryker\Shared\Config\Environment;
use Spryker\Zed\Cache\Communication\Console\EmptyAllCachesConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleClientCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleServiceCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleSharedCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleYvesCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleZedCodeGeneratorConsole;
use Spryker\Zed\Console\ConsoleDependencyProvider as SprykerConsoleDependencyProvider;
use Spryker\Zed\CustomersRestApi\Communication\Console\CustomerAddressesUuidWriterConsole;
use Spryker\Zed\DataImport\Communication\Console\DataImportConsole;
use Spryker\Zed\DataImport\Communication\Console\DataImportDumpConsole;
use Spryker\Zed\Development\Communication\Console\CodeArchitectureSnifferConsole;
use Spryker\Zed\Development\Communication\Console\CodePhpMessDetectorConsole;
use Spryker\Zed\Development\Communication\Console\CodePhpstanConsole;
use Spryker\Zed\Development\Communication\Console\CodeStyleSnifferConsole;
use Spryker\Zed\Development\Communication\Console\CodeTestConsole;
use Spryker\Zed\Development\Communication\Console\GenerateClientIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateGlueIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateServiceIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateYvesIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateZedIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\PluginUsageFinderConsole;
use Spryker\Zed\Development\Communication\Console\PropelAbstractValidateConsole;
use Spryker\Zed\DocumentationGeneratorRestApi\Communication\Console\GenerateRestApiDocumentationConsole;
use Spryker\Zed\EventBehavior\Communication\Console\EventBehaviorTriggerTimeoutConsole;
use Spryker\Zed\EventBehavior\Communication\Console\EventTriggerConsole;
use Spryker\Zed\EventBehavior\Communication\Plugin\Console\EventBehaviorPostHookPlugin;
use Spryker\Zed\IndexGenerator\Communication\Console\PostgresIndexGeneratorConsole;
use Spryker\Zed\IndexGenerator\Communication\Console\PostgresIndexRemoverConsole;
use Spryker\Zed\Installer\Communication\Console\InitializeDatabaseConsole;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Log\Communication\Console\DeleteLogFilesConsole;
use Spryker\Zed\Maintenance\Communication\Console\MaintenanceDisableConsole;
use Spryker\Zed\Maintenance\Communication\Console\MaintenanceEnableConsole;
use Spryker\Zed\Money\Communication\Plugin\ServiceProvider\TwigMoneyServiceProvider;
use Spryker\Zed\Propel\Communication\Console\DatabaseDropConsole;
use Spryker\Zed\Propel\Communication\Console\DatabaseExportConsole;
use Spryker\Zed\Propel\Communication\Console\DatabaseImportConsole;
use Spryker\Zed\Propel\Communication\Console\DeleteMigrationFilesConsole;
use Spryker\Zed\Propel\Communication\Console\PropelSchemaValidatorConsole;
use Spryker\Zed\Propel\Communication\Console\PropelSchemaXmlNameValidatorConsole;
use Spryker\Zed\Propel\Communication\Plugin\ServiceProvider\PropelServiceProvider;
use Spryker\Zed\Queue\Communication\Console\QueueTaskConsole;
use Spryker\Zed\Queue\Communication\Console\QueueWorkerConsole;
use Spryker\Zed\RabbitMq\Communication\Console\DeleteAllExchangesConsole;
use Spryker\Zed\RabbitMq\Communication\Console\DeleteAllQueuesConsole;
use Spryker\Zed\RabbitMq\Communication\Console\PurgeAllQueuesConsole;
use Spryker\Zed\RabbitMq\Communication\Console\SetUserPermissionsConsole;
use Spryker\Zed\RestRequestValidator\Communication\Console\BuildValidationCacheConsole;
use Spryker\Zed\Search\Communication\Console\GenerateIndexMapConsole;
use Spryker\Zed\Search\Communication\Console\SearchCloseIndexConsole;
use Spryker\Zed\Search\Communication\Console\SearchConsole;
use Spryker\Zed\Search\Communication\Console\SearchCopyIndexConsole;
use Spryker\Zed\Search\Communication\Console\SearchCreateSnapshotConsole;
use Spryker\Zed\Search\Communication\Console\SearchDeleteIndexConsole;
use Spryker\Zed\Search\Communication\Console\SearchDeleteSnapshotConsole;
use Spryker\Zed\Search\Communication\Console\SearchOpenIndexConsole;
use Spryker\Zed\Search\Communication\Console\SearchRegisterSnapshotRepositoryConsole;
use Spryker\Zed\Search\Communication\Console\SearchRestoreSnapshotConsole;
use Spryker\Zed\Session\Communication\Console\SessionRemoveLockConsole;
use Spryker\Zed\Setup\Communication\Console\DeployPreparePropelConsole;
use Spryker\Zed\Setup\Communication\Console\EmptyGeneratedDirectoryConsole;
use Spryker\Zed\Setup\Communication\Console\InstallConsole;
use Spryker\Zed\Setup\Communication\Console\JenkinsDisableConsole;
use Spryker\Zed\Setup\Communication\Console\JenkinsEnableConsole;
use Spryker\Zed\Setup\Communication\Console\JenkinsGenerateConsole;
use Spryker\Zed\Setup\Communication\Console\Npm\RunnerConsole;
use Spryker\Zed\SetupFrontend\Communication\Console\CleanUpDependenciesConsole;
use Spryker\Zed\SetupFrontend\Communication\Console\InstallPackageManagerConsole;
use Spryker\Zed\SetupFrontend\Communication\Console\InstallProjectDependenciesConsole;
use Spryker\Zed\SetupFrontend\Communication\Console\YvesBuildFrontendConsole;
use Spryker\Zed\SetupFrontend\Communication\Console\YvesInstallDependenciesConsole;
use Spryker\Zed\SetupFrontend\Communication\Console\ZedBuildFrontendConsole;
use Spryker\Zed\SetupFrontend\Communication\Console\ZedInstallDependenciesConsole;
use Spryker\Zed\Storage\Communication\Console\StorageDeleteAllConsole;
use Spryker\Zed\Storage\Communication\Console\StorageExportRdbConsole;
use Spryker\Zed\Storage\Communication\Console\StorageImportRdbConsole;
use Spryker\Zed\Synchronization\Communication\Console\ExportSynchronizedDataConsole;
use Spryker\Zed\Transfer\Communication\Console\DataBuilderGeneratorConsole;
use Spryker\Zed\Transfer\Communication\Console\GeneratorConsole;
use Spryker\Zed\Transfer\Communication\Console\ValidatorConsole;
use Spryker\Zed\Twig\Communication\Console\CacheWarmerConsole;
use Spryker\Zed\Twig\Communication\Plugin\ServiceProvider\TwigServiceProvider as SprykerTwigServiceProvider;
use Spryker\Zed\ZedNavigation\Communication\Console\BuildNavigationConsole;
use Stecman\Component\Symfony\Console\BashCompletion\CompletionCommand;

/**
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    protected function getConsoleCommands(Container $container)
    {
        $commands = [
            new CacheWarmerConsole(),
            new BuildNavigationConsole(),
            new BuildValidationCacheConsole(),
            new EmptyAllCachesConsole(),
            new GeneratorConsole(),
            new InitializeDatabaseConsole(),
            new SearchConsole(),
            new GenerateIndexMapConsole(),
            new SessionRemoveLockConsole(),
            new QueueTaskConsole(),
            new QueueWorkerConsole(),
            new DataImportConsole(),
            new DataImportConsole(DataImportConsole::DEFAULT_NAME . ':' . DataImportConfig::IMPORT_TYPE_STORE),
            new DataImportConsole(DataImportConsole::DEFAULT_NAME . ':' . DataImportConfig::IMPORT_TYPE_CATEGORY_TEMPLATE),
            new DataImportConsole(DataImportConsole::DEFAULT_NAME . ':' . DataImportConfig::IMPORT_TYPE_CUSTOMER),
            new DataImportConsole(DataImportConsole::DEFAULT_NAME . ':' . DataImportConfig::IMPORT_TYPE_GLOSSARY),

            // Publish and Synchronization
            new EventBehaviorTriggerTimeoutConsole(),
            new EventTriggerConsole(),
            new ExportSynchronizedDataConsole(),

            // Setup commands
            new RunnerConsole(),
            new EmptyGeneratedDirectoryConsole(),
            new InstallConsole(),
            new JenkinsEnableConsole(),
            new JenkinsDisableConsole(),
            new JenkinsGenerateConsole(),
            new DeployPreparePropelConsole(),

            new DatabaseDropConsole(),

            new DatabaseExportConsole(),
            new DatabaseImportConsole(),
            new DeleteMigrationFilesConsole(),

            new DeleteLogFilesConsole(),
            new StorageExportRdbConsole(),
            new StorageImportRdbConsole(),
            new StorageDeleteAllConsole(),
            new SearchDeleteIndexConsole(),
            new SearchCloseIndexConsole(),
            new SearchOpenIndexConsole(),
            new SearchRegisterSnapshotRepositoryConsole(),
            new SearchDeleteSnapshotConsole(),
            new SearchCreateSnapshotConsole(),
            new SearchRestoreSnapshotConsole(),
            new SearchCopyIndexConsole(),

            new InstallPackageManagerConsole(),
            new CleanUpDependenciesConsole(),
            new InstallProjectDependenciesConsole(),

            new YvesInstallDependenciesConsole(),
            new YvesBuildFrontendConsole(),

            new ZedInstallDependenciesConsole(),
            new ZedBuildFrontendConsole(),

            new DeleteAllQueuesConsole(),
            new PurgeAllQueuesConsole(),
            new DeleteAllExchangesConsole(),
            new SetUserPermissionsConsole(),

            new MaintenanceEnableConsole(),
            new MaintenanceDisableConsole(),

            new CustomerAddressesUuidWriterConsole(),

            new TimeAccountingConsole(),
        ];

        $propelCommands = $container->getLocator()->propel()->facade()->getConsoleCommands();
        $commands = array_merge($commands, $propelCommands);

        if (Environment::isDevelopment() || Environment::isTesting()) {
            $commands[] = new CodeTestConsole();
            $commands[] = new CodeStyleSnifferConsole();
            $commands[] = new CodeArchitectureSnifferConsole();
            $commands[] = new CodePhpstanConsole();
            $commands[] = new CodePhpMessDetectorConsole();
            $commands[] = new ValidatorConsole();
            $commands[] = new BundleCodeGeneratorConsole();
            $commands[] = new BundleYvesCodeGeneratorConsole();
            $commands[] = new BundleZedCodeGeneratorConsole();
            $commands[] = new BundleServiceCodeGeneratorConsole();
            $commands[] = new BundleSharedCodeGeneratorConsole();
            $commands[] = new BundleClientCodeGeneratorConsole();
            $commands[] = new GenerateZedIdeAutoCompletionConsole();
            $commands[] = new GenerateClientIdeAutoCompletionConsole();
            $commands[] = new GenerateServiceIdeAutoCompletionConsole();
            $commands[] = new GenerateYvesIdeAutoCompletionConsole();
            $commands[] = new GenerateIdeAutoCompletionConsole();
            $commands[] = new DataBuilderGeneratorConsole();
            $commands[] = new CompletionCommand();
            $commands[] = new DataBuilderGeneratorConsole();
            $commands[] = new PropelSchemaValidatorConsole();
            $commands[] = new PropelSchemaXmlNameValidatorConsole();
            $commands[] = new DataImportDumpConsole();
            $commands[] = new GenerateGlueIdeAutoCompletionConsole();
            $commands[] = new PropelAbstractValidateConsole();
            $commands[] = new PluginUsageFinderConsole();
            $commands[] = new PostgresIndexGeneratorConsole();
            $commands[] = new PostgresIndexRemoverConsole();
            $commands[] = new GenerateRestApiDocumentationConsole();
        }

        return $commands;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array
     */
    public function getConsolePostRunHookPlugins(Container $container)
    {
        return [
            new EventBehaviorPostHookPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Silex\ServiceProviderInterface[]
     */
    public function getServiceProviders(Container $container)
    {
        $serviceProviders = parent::getServiceProviders($container);
        $serviceProviders[] = new PropelServiceProvider();
        $serviceProviders[] = new SilexTwigServiceProvider();
        $serviceProviders[] = new SprykerTwigServiceProvider();
        $serviceProviders[] = new TwigMoneyServiceProvider();

        return $serviceProviders;
    }
}
