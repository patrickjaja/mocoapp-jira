<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Dependency\Plugin\ShoppingListWidget;

use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;

/**
 * @deprecated Use \Pyz\Yves\ShoppingListWidget\Widget\ShoppingListMenuItemWidget instead.
 */
interface ShoppingListMenuItemWidgetPluginInterface extends WidgetPluginInterface
{
    public const NAME = 'ShoppingListMenuItemWidgetPlugin';

    /**
     * @api
     *
     * @param string $activePage
     * @param int|null $activeEntityId
     *
     * @return void
     */
    public function initialize(string $activePage, ?int $activeEntityId = null): void;
}
