<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

/**
 * AUTHENT Routes
 */
$app->group('/authent', function () {
    /**
     * authentLogin : Authenticating a Cobiz user via email and password
     */
    $this->POST('/login', '\Controllers\AuthentApiController:authentLogin');
    /**
     * authentReset : Password Change Request from a Cobiz User
     */
    $this->POST('/reset', '\Controllers\AuthentApiController:authentReset');
    /**
     * authentResetConfirm : Changing the password of a user who has made a request
     */
    $this->POST('/reset/{reset_Token}/confirm', '\Controllers\AuthentApiController:authentResetconfirm');
    /**
     * authentInit : Request to create a user Cobiz, Temporary Creation of a user with the status: Is_confirmed = FALSE
     */
    $this->POST('/init', '\Controllers\AuthentApiController:authentInit');
    /**
     * authentInitConfirm : Changing a user with status: is_confirmed = FALSE to is_confirmed = TRUE
     */
    $this->POST('/init/{init_Token}/confirm', '\Controllers\AuthentApiController:authentinitConfirm');
});
