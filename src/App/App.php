<?php
namespace App;

use \Functional as F;

class App {

	public static $framework;
	public static $config;

	public static function template($path /* ...$args */) {
		$template = new Template();
		$args = array_slice(func_get_args(), 1);
		$vars = F\reduce_left(F\invoke($args, 'templateVars'), function($vars, $i, $collection, $carry) { return array_merge($vars, $carry); }, []);
		return $template->render($path, $vars);
	}

	public static function notFound($response, $exception=null) {
		if (DEBUG) {
			var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $exception);
			exit(0);
		}
		return $response->withStatus(404);
	}

	public static function routeLookUp($path, $placeholders=null) {
		return self::$framework->getContainer()->get('router')->pathFor($path, $placeholders);
	}

}
