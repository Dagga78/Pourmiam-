<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace \Controllers;

/**
 * Description of DishApiController
 *
 * @author patrick
 */
class DishApiController extends ApiController{


/**
 * function dishCreate:
 * params :
 *  dish: \\Models\Dish
 * @author CodeGen
 */
    public function dishCreate($request, $response, $args) {

        $body = $request->getParsedBody();
        $dish = $body['dish'];
        $response->write('How about implementing dishCreate as a POST method ?');
        return $response->withJSON();

    }

# end of operations block
}
