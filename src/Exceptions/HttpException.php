<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exceptions;

/**
 * Description of HttpException
 *
 * @author patrick
 */
class HttpException extends \Exception
{

    const BAD_REQUEST_CODE = 400;
    const UNAUTHORIZED_CODE = 401;
    const FORBIDDEN_CODE = 403;
    const NOT_FOUND_CODE = 404;
    const METHOD_NOT_ALLOWED = 405;
    const UNPROCESSABLE_ENTITY = 422;
    const SERVER_ERROR = 500;
}
