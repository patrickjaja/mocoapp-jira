<?php

/**
 * Notes:
 *
 * - jobs[]['name'] must not contains spaces or any other characters, that have to be urlencode()'d
 * - jobs[]['role'] default value is 'admin'
 */

$stores = require(APPLICATION_ROOT_DIR . '/config/Shared/stores.php');

$allStores = array_keys($stores);

$jobs[] = [
    'name' => 'mocoapp-queue-start',
    'command' => '$PHP_BIN vendor/bin/console q:t:s mocoapp.queue',
    'schedule' => '* * * * *',
    'enable' => true,
    'run_on_non_production' => true,
    'stores' => $allStores,
];


$jobs[] = [
    'name' => 'timeaccounting-start',
    'command' => '$PHP_BIN vendor/bin/console timeaccounting:import',
    'schedule' => '0 * * * *',
    'enable' => true,
    'run_on_non_production' => true,
    'stores' => $allStores,
];

