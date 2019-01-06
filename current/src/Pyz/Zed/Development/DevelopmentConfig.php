<?php

namespace Pyz\Zed\Development;

use Spryker\Zed\Development\DevelopmentConfig as SprykerDevelopmentConfig;

class DevelopmentConfig extends SprykerDevelopmentConfig
{
    /**
     * @return string
     */
    public function getCodingStandard()
    {
        $rootDir = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR;

        return $rootDir . 'config/ruleset.xml';
    }
}
