<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Dependency\Plugin\CartNoteWidget;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;

/**
 * @deprecated Use molecule('note-list', 'CartNoteWidget') instead.
 */
interface CartNoteOrderNoteWidgetPluginInterface extends WidgetPluginInterface
{
    public const NAME = 'CartNoteOrderNoteWidgetPlugin';

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return void
     */
    public function initialize(OrderTransfer $orderTransfer): void;
}
