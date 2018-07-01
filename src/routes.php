<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


/**
 * AUTHENT Routes
 */
$app->group('/authent', function () {
    /**
     * authentLogin : Authenticating a Pourmiam user via email and password
     */
    $this->POST('/login', '\Controllers\AuthentApiController:authentLogin');
    /**
     * authentReset : Password Change Request from a Pourmiam User
     */
    $this->POST('/reset', '\Controllers\AuthentApiController:authentReset');
    /**
     * authentResetConfirm : Changing the password of a user who has made a request
     */
    $this->POST('/reset/{reset_Token}/confirm', '\Controllers\AuthentApiController:authentResetconfirm');
    /**
     * authentInit : Request to create a user Pourmiam, Temporary Creation of a user with the status: Is_confirmed = FALSE
     */
    $this->POST('/init', '\Controllers\AuthentApiController:authentInit');
    /**
     * authentInitConfirm : Changing a user with status: is_confirmed = FALSE to is_confirmed = TRUE
     */
    $this->POST('/init/{init_Token}/confirm', '\Controllers\AuthentApiController:authentinitConfirm');
});

$app->group('/comentary', function () {
    /**
     * comentaryCreate: create a commentary
     */
    $this->POST('', '\Controllers\ComentaryApiController:comentaryCreate');
    /**
     * comentaryDelete: delete a comentary
     */
    $this->DELETE('/{comentaryId}', '\Controllers\ComentaryApiController:comentaryDelete');
    /**
     * comentaryFind: find comentary
     */
    $this->GET('', '\Controllers\ComentaryApiController:comentaryFind');
    /**
     * comentaryUpdate: Update a comentary
     */
    $this->PUT('/{comentaryId}', '\Controllers\ComentaryApiController:comentaryUpdate');

})->add('TokenAuth');


$app->group('/restaurant', function () {
    /**
     * GET restaurantFind
     * Summary: Recherche des restaurant par nom ou par ville
     * Notes: Recherche de restaurant dans la base Local avec le debut du nom ou la ville.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity
     * Output-Formats: [application/json;charset=utf-8]
     */
    $this->GET('', '\Controllers\RestaurantApiController:restaurantFind');

    /**
     * GET restaurantFind
     * Summary: Recherche des restaurant par nom ou par ville
     * Notes: Recherche de restaurant dans la base Local avec le debut du nom ou la ville.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity
     * Output-Formats: [application/json;charset=utf-8]
     */
    $this->GET('/[{id:[0-9]+}]', '\Controllers\RestaurantApiController:restaurantGet');
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});