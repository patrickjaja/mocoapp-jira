<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Dependency\Plugin\MultiCartMenuItemWidget;

use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;

/**
 * @deprecated Use \Pyz\Yves\MultiCartWidget\Widget\MultiCartMenuItemWidget instead.
 */
interface MultiCartMenuItemWidgetPluginInterface extends WidgetPluginInterface
{
    public const NAME = 'MultiCartMenuItemWidgetPlugin';

    /**
     * Specification:
     *  - Represents the link to multi cart list page on "My account" page in left sidebar
     *
     * @api
     *
     * @param string $activePage
     *
     * @return void
     */
    public function initialize(string $activePage): void;
}
