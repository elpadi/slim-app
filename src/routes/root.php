<?php

\App\App::$framework->group('/', function() {

	$slim = \App\App::$framework;

	$slim->get('test', function($request, $response, $args) {
		return $response->write(' Test pass. ');
	})->setName('test');

})->add(function($request, $response, $next) {

	return $next($request, $response->write(' Group middleware. '));

});
