<?php

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Collector\CollectorConstants;
use Spryker\Shared\Customer\CustomerConstants;
use Spryker\Shared\Event\EventConstants;
use Spryker\Shared\Mail\MailConstants;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Shared\Queue\QueueConstants;
use Spryker\Shared\RabbitMq\RabbitMqEnv;
use Spryker\Shared\Search\SearchConstants;
use Spryker\Shared\Session\SessionConstants;
use Spryker\Shared\UtilDateTime\UtilDateTimeConstants;
use Spryker\Shared\ZedRequest\ZedRequestConstants;

$domain = getenv('VM_PROJECT') ?: 'suite';

// ---------- Yves host
$config[ApplicationConstants::HOST_YVES] = sprintf('www.de.%s.local', $domain);
$config[ApplicationConstants::PORT_YVES] = '';
$config[ApplicationConstants::PORT_SSL_YVES] = '';
$config[ApplicationConstants::BASE_URL_YVES] = sprintf(
    'http://%s%s',
    $config[ApplicationConstants::HOST_YVES],
    $config[ApplicationConstants::PORT_YVES]
);
$config[ApplicationConstants::BASE_URL_SSL_YVES] = sprintf(
    'https://%s%s',
    $config[ApplicationConstants::HOST_YVES],
    $config[ApplicationConstants::PORT_SSL_YVES]
);
$config[CustomerConstants::BASE_URL_YVES] = $config[ApplicationConstants::BASE_URL_YVES];

// ---------- Zed host
$config[ApplicationConstants::HOST_ZED] = sprintf('zed.de.%s.local', $domain);
$config[ApplicationConstants::PORT_ZED] = '';
$config[ApplicationConstants::PORT_SSL_ZED] = '';
$config[ApplicationConstants::BASE_URL_ZED] = sprintf(
    'http://%s%s',
    $config[ApplicationConstants::HOST_ZED],
    $config[ApplicationConstants::PORT_ZED]
);
$config[ApplicationConstants::BASE_URL_SSL_ZED] = sprintf(
    'https://%s%s',
    $config[ApplicationConstants::HOST_ZED],
    $config[ApplicationConstants::PORT_SSL_ZED]
);
$config[ZedRequestConstants::HOST_ZED_API] = $config[ApplicationConstants::HOST_ZED];
$config[ZedRequestConstants::BASE_URL_ZED_API] = $config[ApplicationConstants::BASE_URL_ZED];
$config[ZedRequestConstants::BASE_URL_SSL_ZED_API] = $config[ApplicationConstants::BASE_URL_SSL_ZED];

// ---------- Assets / Media
$config[ApplicationConstants::BASE_URL_STATIC_ASSETS] = $config[ApplicationConstants::BASE_URL_YVES];
$config[ApplicationConstants::BASE_URL_STATIC_MEDIA] = $config[ApplicationConstants::BASE_URL_YVES];
$config[ApplicationConstants::BASE_URL_SSL_STATIC_ASSETS] = $config[ApplicationConstants::BASE_URL_SSL_YVES];
$config[ApplicationConstants::BASE_URL_SSL_STATIC_MEDIA] = $config[ApplicationConstants::BASE_URL_SSL_YVES];

// ---------- Session
$config[SessionConstants::YVES_SESSION_COOKIE_NAME] = $config[ApplicationConstants::HOST_YVES];
$config[SessionConstants::YVES_SESSION_COOKIE_DOMAIN] = $config[ApplicationConstants::HOST_YVES];
$config[SessionConstants::ZED_SESSION_COOKIE_NAME] = $config[ApplicationConstants::HOST_ZED];

// ---------- Events
$config[EventConstants::LOG_FILE_PATH] = APPLICATION_ROOT_DIR . '/data/DE/logs/application_events.log';

$config[UtilDateTimeConstants::DATE_TIME_FORMAT_DATE_TIME]='d.m.Y H:i:s';

// ---------- Propel
$config[PropelConstants::ZED_DB_DATABASE] = 'DE_development_zed';

// ---------- MailCatcher
$config[MailConstants::MAILCATCHER_GUI] = sprintf('http://%s:1080', $config[ApplicationConstants::HOST_ZED]);

// ---------- Elasticsearch
$ELASTICA_INDEX_NAME = 'de_search';
$config[SearchConstants::ELASTICA_PARAMETER__INDEX_NAME] = $ELASTICA_INDEX_NAME;
$config[CollectorConstants::ELASTICA_PARAMETER__INDEX_NAME] = $ELASTICA_INDEX_NAME;

// ---------- Queue
$config[QueueConstants::QUEUE_WORKER_INTERVAL_MILLISECONDS] = 1000;
$config[QueueConstants::QUEUE_WORKER_LOG_ACTIVE] = false;
$config[QueueConstants::QUEUE_WORKER_OUTPUT_FILE_NAME] = 'data/DE/logs/ZED/queue.out';

// ---------- RabbitMQ
$config[RabbitMqEnv::RABBITMQ_CONNECTIONS]['DE'][RabbitMqEnv::RABBITMQ_DEFAULT_CONNECTION] = true;
$config[RabbitMqEnv::RABBITMQ_API_VIRTUAL_HOST] = '/DE_development_zed';
