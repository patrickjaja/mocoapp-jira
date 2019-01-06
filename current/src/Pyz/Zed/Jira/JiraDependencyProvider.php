<?php

namespace Pyz\Zed\Jira;

use GuzzleHttp\Client;
use JiraRestApi\Configuration\ArrayConfiguration;
use JiraRestApi\Issue\IssueService;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JiraDependencyProvider extends AbstractBundleDependencyProvider
{
    public const JIRA_CLIENT = 'JIRA_CLIENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container[self::JIRA_CLIENT] = new IssueService(new ArrayConfiguration(
            array(
                'jiraHost' => 'https://nexus-netsoft.atlassian.net',
                // for basic authorization:
                'jiraUser' => 'xxxxx',
                'jiraPassword' => 'xxxxx',
                // to enable session cookie authorization (with basic authorization only)
//                'cookieAuthEnabled' => true,
//                'cookieFile' => storage_path('jira-cookie.txt'),
                // if you are behind a proxy, add proxy settings
//                "proxyServer" => 'your-proxy-server',
//                "proxyPort" => 'proxy-port',
//                "proxyUser" => 'proxy-username',
//                "proxyPassword" => 'proxy-password',
            )
        ));
        return $container;
    }
}
