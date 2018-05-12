<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace \Controllers;

/**
 * Description of UserApiController
 *
 * @author patrick
 */
class UserApiController extends ApiController{


/**
 * function userGet:
 * params :
 *  id: string
 * @author CodeGen
 */
    public function userGet($request, $response, $args) {

        $response->write('How about implementing userGet as a GET method ?');
        return $response->withJSON();

    }

/**
 * function userUpdate:
 * params :
 *  id: string
 *  user: \\Models\User
 * @author CodeGen
 */
    public function userUpdate($request, $response, $args) {

        $body = $request->getParsedBody();
        $user = $body['user'];
        $response->write('How about implementing userUpdate as a PUT method ?');
        return $response->withJSON();

    }

# end of operations block
}
