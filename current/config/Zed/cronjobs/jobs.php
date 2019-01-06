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
    'name' => 'queue-worker-start',
    'command' => '$PHP_BIN vendor/bin/console queue:worker:start',
    'schedule' => '* * * * *',
    'enable' => true,
    'run_on_non_production' => true,
    'stores' => $allStores,
];


$jobs[] = [
  'name' => 'event-trigger-timeout',
  'command' => '$PHP_BIN vendor/bin/console event:trigger:timeout -vvv',
  'schedule' => '*/5 * * * *',
  'enable' => true,
  'run_on_non_production' => true,
'stores' => $allStores,
];
