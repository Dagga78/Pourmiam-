<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MissingParameterException
 *
 * @author patrick
 */

namespace Exceptions;

class InvalidCredentialsException extends HttpException
{

    private $errors = [];

    public function __construct($errors = [])
    {
        $this->errors = $errors;
        parent::__construct("Invalid Credentials", self::UNAUTHORIZED_CODE);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
