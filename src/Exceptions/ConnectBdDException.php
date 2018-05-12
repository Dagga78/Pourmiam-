<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnectBdDException
 *
 * @author jl
 */

namespace Exceptions;

class ConnectBdDException extends HttpException
{

    private $errors = [];

    public function __construct($errors = [])
    {
        $this->errors = $errors;
        parent::__construct("Error connecting BdD : " . $this->errors, self::SERVER_ERROR);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
