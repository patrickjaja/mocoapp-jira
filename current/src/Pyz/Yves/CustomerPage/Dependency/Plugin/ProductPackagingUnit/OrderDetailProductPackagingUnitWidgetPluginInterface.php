<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Dependency\Plugin\ProductPackagingUnit;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;

/**
 * @deprecated Use molecule('order-detail-product-packaging-unit', 'ProductPackagingUnitWidget') instead.
 */
interface OrderDetailProductPackagingUnitWidgetPluginInterface extends WidgetPluginInterface
{
    public const NAME = 'OrderDetailProductPackagingUnitWidgetPlugin';

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param string $currencyIsoCode
     *
     * @return void
     */
    public function initialize(ItemTransfer $itemTransfer, string $currencyIsoCode): void;
}
