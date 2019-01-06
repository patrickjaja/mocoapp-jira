<?php

namespace Pyz\Zed\Auth;

use Spryker\Zed\Auth\AuthConfig as SprykerAuthConfig;

class AuthConfig extends SprykerAuthConfig
{
    /**
     * @return array
     */
    public function getIgnorable()
    {
        $this->addIgnorable('heartbeat', 'index', 'index');
        $this->addIgnorable('_profiler', 'wdt', '*');

        return parent::getIgnorable();
    }
}
