<?php

namespace Pyz\Yves\CustomerPage;

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class CustomerPageConfig extends AbstractBundleConfig
{
    protected const MIN_LENGTH_CUSTOMER_PASSWORD = 1;

    /**
     * @return string
     */
    public function getYvesHost()
    {
        return $this->get(ApplicationConstants::HOST_YVES);
    }

    /**
     * @return int
     */
    public function getCustomerPasswordMinLength(): int
    {
        return static::MIN_LENGTH_CUSTOMER_PASSWORD;
    }
}
