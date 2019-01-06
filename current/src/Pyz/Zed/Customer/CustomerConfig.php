<?php

namespace Pyz\Zed\Customer;

use Spryker\Zed\Customer\CustomerConfig as SprykerCustomerConfig;

class CustomerConfig extends SprykerCustomerConfig
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCustomerDetailExternalBlocksUrls()
    {
        return [
            'notes' => '/customer-note-gui/index/index',
        ] + parent::getCustomerDetailExternalBlocksUrls();
    }
}
