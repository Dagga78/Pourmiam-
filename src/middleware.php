<?php

// Application middleware
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


// CORS setup
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response->withHeader('Access-Control-Allow-Origin', '*')
                    ->withHeader('Access-Control-Allow-Headers','X-Requested-With, Content-Type, Accept, Access-Control-Allow-Origin, Origin, Authorization, cache-control, if-modified-since, Pragma')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, HEAD');
});

//	Retourne forcement du json meme pour les erreurs 404 ...
$app->add(function (
    ServerRequestInterface $request,
    ResponseInterface $response,
    callable $next
) {
    $newRequest = $request->withHeader('Accept', 'application/json');

    return $next($newRequest, $response);
});
