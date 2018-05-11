<?php

namespace Controllers;

/**
 * Description of Controller
 *
 * @author patrick
 */
use Interop\Container\ContainerInterface;

class ApiController {

  protected $ci;

  public function __construct(ContainerInterface $ci) {
    $this->ci = $ci;
  }

}
