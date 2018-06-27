<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace Controllers;

/**
 * Description of RestaurantApiController
 *
 * @author patrick
 */
class RestaurantApiController extends ApiController{


/**
 * function restaurantFind:
 * params :
 *  city: string
 *  name: string
 * @author CodeGen
 */
    public function restaurantFind($request, $response, $args) {

        $params = $request->getQueryParams();
        if (empty($params['city'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $ville = filter_var($params['city'], FILTER_SANITIZE_STRING);
        $data = $this->db->fetchAssoc("SELECT * FROM restaurant WHERE city = ?",[$ville]);
        if ( empty($data) ) {
            throw new \Exceptions\InvalidCredentialsException();
        }
        else{
            return $response->withJSON($data);
        }


    }


}
