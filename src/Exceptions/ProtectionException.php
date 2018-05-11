<?php

/**
 * Description of ProtectionException
 *
 * Exception triggered when unauthorized acces is tried on the api
 *
 * @author patrick
 */

namespace Exceptions;

class ProtectionException extends HttpException
{

    public function __construct()
    {
        parent::__construct("Unauthorized  Missing or Invalid credentials", self::UNAUTHORIZED_CODE);
    }
}
