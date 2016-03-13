<?php
define('PUBLIC_DIR', __DIR__);
$app_dir = isset($_ENV['APP_DIR']) ? $_ENV['APP_DIR'] : dirname(__DIR__);
require(realpath($app_dir).'/src/bootstrap.php');
