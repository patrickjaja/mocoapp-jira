<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Dependency\Plugin\BusinessOnBehalfWidget;

use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;

/**
 * @deprecated Use \Pyz\Yves\BusinessOnBehalfWidget\Widget\BusinessOnBehalfStatusWidget instead.
 */
interface MenuItemBusinessOnBehalfWidgetPluginInterface extends WidgetPluginInterface
{
    public const NAME = 'MenuItemBusinessOnBehalfWidgetPlugin';

    /**
     * @api
     *
     * @return void
     */
    public function initialize(): void;
}
