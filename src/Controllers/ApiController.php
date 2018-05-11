<?php

namespace Controllers;

use Interop\Container\ContainerInterface;

/**
 * Base for All controller. Store Container on construct
 *
 * @author patrick
 */
abstract class ApiController
{

    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
        $this->db = $ci['db'];
    }
}
