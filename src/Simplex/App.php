<?php

namespace Simplex;

use Simplex\Providers\TwigServiceProvider;

class App
{

  private $config;

  public function __construct() {
    $this->loadConfig();

    $twig = new TwigServiceProvider();
    $this->view = $twig->provide();
  }

  public function loadConfig() {
    $this->config = include(__DIR__.'/../config.php');
  }
  
}