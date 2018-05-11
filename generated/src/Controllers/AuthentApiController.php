<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace \Controllers;

/**
 * Description of AuthentApiController
 *
 * @author patrick
 */
class AuthentApiController extends ApiController{


/**
 * function authentInit:
 * params :
 * @author CodeGen
 */
    public function authentInit($request, $response, $args) {

        $response->write('How about implementing authentInit as a POST method ?');
        return $response->withJSON();

    }

/**
 * function authentInitconfirm:
 * params :
 *  token: string
 * @author CodeGen
 */
    public function authentInitconfirm($request, $response, $args) {

        $response->write('How about implementing authentInitconfirm as a POST method ?');
        return $response->withJSON();

    }

/**
 * function authentLogin:
 * params :
 *  email: string
 *  password: string
 * @author CodeGen
 */
    public function authentLogin($request, $response, $args) {
        $queryParams = $request->getQueryParams();
        $email = $queryParams['email'];
        $password = $queryParams['password'];

        $response->write('How about implementing authentLogin as a POST method ?');
        return $response->withJSON();

    }

/**
 * function authentReset:
 * params :
 *  email: string
 * @author CodeGen
 */
    public function authentReset($request, $response, $args) {
        $queryParams = $request->getQueryParams();
        $email = $queryParams['email'];

        $response->write('How about implementing authentReset as a POST method ?');
        return $response->withJSON();

    }

/**
 * function authentResetconfirm:
 * params :
 *  token: string
 * @author CodeGen
 */
    public function authentResetconfirm($request, $response, $args) {

        $response->write('How about implementing authentResetconfirm as a POST method ?');
        return $response->withJSON();

    }

# end of operations block
}
