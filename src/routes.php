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

/**
 *  User Api
 */
$app->group('/user', function () {
    //usersGet : Get information from my account.
    $this->get('', '\Controllers\UserApiController:usersGet');
})->add('TokenAuth');

$app->group('/restaurant', function () {
    /**
     * GET restaurantFind
     */
    $this->GET('', '\Controllers\RestaurantApiController:restaurantFind');
    /**
     * GET restaurantGet
     */
    $this->GET('/[{id:[0-9]+}]', '\Controllers\RestaurantApiController:restaurantGet');
    /**
     *  POST restaurantUp
     */
    $this->GET('/positif/[{id:[0-9]+}]', '\Controllers\RestaurantApiController:restaurantUp');
    /**
     *  POST restaurantDown
     */
    $this->GET('/negatif/[{id:[0-9]+}]', '\Controllers\RestaurantApiController:restaurantDown');
});

$app->group('/plats', function () {
    /**
     * Get PlatByRestaurant
     */
    $this->POST('', '\Controllers\DishApiController:dishGetByRestaurant');

});


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});