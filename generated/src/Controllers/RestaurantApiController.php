<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace \Controllers;

/**
 * Description of RestaurantApiController
 *
 * @author patrick
 */
class RestaurantApiController extends ApiController{


/**
 * function restaurantCreate:
 * params :
 *  restaurant: \\Models\Restaurant
 * @author CodeGen
 */
    public function restaurantCreate($request, $response, $args) {

        $body = $request->getParsedBody();
        $restaurant = $body['restaurant'];
        $response->write('How about implementing restaurantCreate as a POST method ?');
        return $response->withJSON();

    }

/**
 * function restaurantFind:
 * params :
 *  city: string
 *  name: string
 * @author CodeGen
 */
    public function restaurantFind($request, $response, $args) {

        $response->write('How about implementing restaurantFind as a GET method ?');
        return $response->withJSON();

    }

/**
 * function restaurantGet:
 * params :
 *  id: string
 * @author CodeGen
 */
    public function restaurantGet($request, $response, $args) {

        $response->write('How about implementing restaurantGet as a GET method ?');
        return $response->withJSON();

    }

/**
 * function restaurantUpdate:
 * params :
 *  id: string
 *  restaurant: \\Models\Restaurant
 * @author CodeGen
 */
    public function restaurantUpdate($request, $response, $args) {

        $body = $request->getParsedBody();
        $restaurant = $body['restaurant'];
        $response->write('How about implementing restaurantUpdate as a PUT method ?');
        return $response->withJSON();

    }

# end of operations block
}
