<?php

namespace Pyz\Zed\Setup;

use Spryker\Zed\Cache\Communication\Console\EmptyAllCachesConsole;
use Spryker\Zed\Installer\Communication\Console\InitializeDatabaseConsole;
use Spryker\Zed\Propel\Communication\Console\PropelInstallConsole;
use Spryker\Zed\Search\Communication\Console\SearchConsole;
use Spryker\Zed\Setup\Communication\Console\EmptyGeneratedDirectoryConsole;
use Spryker\Zed\Setup\SetupConfig as SprykerSetupConfig;
use Spryker\Zed\Transfer\Communication\Console\GeneratorConsole;
use Spryker\Zed\ZedNavigation\Communication\Console\BuildNavigationConsole;

class SetupConfig extends SprykerSetupConfig
{
    /**
     * The following commands are a boilerplate stack. Please customize for your project.
     *
     * For a first initial migration you must use OPTION_NO_DIFF false.
     *
     * @return array
     */
    public function getSetupInstallCommandNames()
    {
        return [
            EmptyAllCachesConsole::COMMAND_NAME,
            EmptyGeneratedDirectoryConsole::COMMAND_NAME,
            // Important note: After first initial migration you must use
            // PropelInstallConsole::COMMAND_NAME => ['--' . PropelInstallConsole::OPTION_NO_DIFF => true]
            // from there on to persist migration files.
            PropelInstallConsole::COMMAND_NAME,
            GeneratorConsole::COMMAND_NAME,
            InitializeDatabaseConsole::COMMAND_NAME,
            BuildNavigationConsole::COMMAND_NAME,
            SearchConsole::COMMAND_NAME,
        ];
    }
}
