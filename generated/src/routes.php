<?php
/**
 * API Gastronoslim
 * @version 0.1.0_inProgress
 */

$app->get('/', function($request, $response, $args) {
    return $this->view->render($response, "index.phtml");
});

$app->get('/version',  function ($request, $response, $args) {
    $version = "0.1.0_inProgress";
    return $response->withJSON($version);
})->setName('version');




/**
 * POST authentInit
 * Summary: Create a temporary account.
 * Notes: Create temp account for user with status&#x3D;&#39;init&#39;  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/authent/init','\Controllers\AuthentApiController:authentInit');

/**
 * POST authentInitconfirm
 * Summary: Confirm account creation.
 * Notes: status&#x3D;&#39;confirm&#39;, user now valid ( bconfirm &#x3D; true ?)  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/authent/{token}/initconfirm','\Controllers\AuthentApiController:authentInitconfirm');

/**
 * POST authentLogin
 * Summary: Get a valid token with credentials.
 * Notes: Authentification d&#39;un utilisateur Cobiz. Password en clair, encryptée en bcrypt(13) coté base de données  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/authent/login','\Controllers\AuthentApiController:authentLogin');

/**
 * POST authentReset
 * Summary: Demande de changement d&#39;un mot de passe utilisateur. (forgot password)
 * Notes: Reset du mot de passe d&#39;un utilisateur PourMiam&#39;.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/authent/reset','\Controllers\AuthentApiController:authentReset');

/**
 * POST authentResetconfirm
 * Summary: modification du mot de passe d&#39;un utilisateur.
 * Notes: Modification du Password d&#39;un utilisateur PourMiam&#39;. Password en clair, encryptée en bcrypt(13) coté base de données.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/authent/{token}/resetconfirm','\Controllers\AuthentApiController:authentResetconfirm');




/**
 * POST comentaryCreate
 * Summary: create a commentary
 * Notes: create a commentary  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/comentary','\Controllers\ComentaryApiController:comentaryCreate');

/**
 * DELETE comentaryDelete
 * Summary: delete a comentary
 * Notes: delete a comentary  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->DELETE('/comentary/{comentaryId}','\Controllers\ComentaryApiController:comentaryDelete');

/**
 * GET comentaryFind
 * Summary: find comentary
 * Notes: find comentary  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->GET('/comentary','\Controllers\ComentaryApiController:comentaryFind');

/**
 * PUT comentaryUpdate
 * Summary: Update a comentary
 * Notes: Update a comentary  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->PUT('/comentary/{comentaryId}','\Controllers\ComentaryApiController:comentaryUpdate');




/**
 * POST dishCreate
 * Summary: creation des plats.
 * Notes: creation d&#39;un plat dans la database local  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/dish','\Controllers\DishApiController:dishCreate');




/**
 * POST restaurantCreate
 * Summary: Creation d&#39;un restaurant.
 * Notes: Creation dans la base local d&#39;unrestaurant  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->POST('/restaurant','\Controllers\RestaurantApiController:restaurantCreate');

/**
 * GET restaurantFind
 * Summary: Recherche des restaurant par nom ou par ville
 * Notes: Recherche de restaurant dans la base Local avec le debut du nom ou la ville.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->GET('/restaurant','\Controllers\RestaurantApiController:restaurantFind');

/**
 * GET restaurantGet
 * Summary: Recherche d&#39;un restaurant.
 * Notes: Recuperation des infos d&#39;un restaurant  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->GET('/restaurant/{id}','\Controllers\RestaurantApiController:restaurantGet');

/**
 * PUT restaurantUpdate
 * Summary: Modification des information d&#39;un restaurant.
 * Notes: modification des infos d&#39;un restaurant.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->PUT('/restaurant/{id}','\Controllers\RestaurantApiController:restaurantUpdate');




/**
 * GET userGet
 * Summary: Recuperation des infos de mon compte
 * Notes: le token d&#39;authen permet de recuperer le current_user.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->GET('/user/{id}','\Controllers\UserApiController:userGet');

/**
 * PUT userUpdate
 * Summary: modification d&#39;un utilisateur
 * Notes: Modification du profil d&#39;un utilisateur PourMiam&#39;.  Specific business errors for current operation will be encapsulated in  HTTP Response 422 Unprocessable entity 
 * Output-Formats: [application/json;charset=utf-8]
 */
$app->PUT('/user/{id}','\Controllers\UserApiController:userUpdate');



