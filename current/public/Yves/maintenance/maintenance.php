<?php

if (file_exists(__DIR__ . '/maintenance.marker')) {
    http_response_code(503);
    echo file_get_contents(__DIR__ . '/index.html');
    die();
}
