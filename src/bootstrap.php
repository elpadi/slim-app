<?php
use App\App;
use Noodlehaus\Config;
use Symfony\Component\Finder\Finder;

define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', "::1")) || strpos($_SERVER['HTTP_HOST'], 'localhost') !== false);
require(dirname(__DIR__).'/vendor/autoload.php');
App::$config = new Config(dirname(__DIR__).'/config');

defined('DEBUG') or define('DEBUG', IS_LOCAL || App::$config->get('debug'));
ini_set('display_errors', DEBUG ? 'on' : 'off');
error_reporting(DEBUG ? E_ERROR | E_WARNING | E_PARSE | E_NOTICE : 0);

App::$framework = new \Slim\App;

$finder = new Symfony\Component\Finder\Finder();
$finder->files()->in(__DIR__.'/routes');
foreach ($finder as $file) require($file->getRealpath());

App::$framework->run();
