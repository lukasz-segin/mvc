<?php

namespace Simplex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;

/**
 * Created by PhpStorm.
 * User: workstation-php
 * Date: 16.03.17
 * Time: 12:19
 */
class Framework
{
  protected $matcher;
  protected $resolver;
  protected $resolverInterface;

  public function __construct(UrlMatcher $matcher, ControllerResolver $resolver, ArgumentResolver $resolverInterface) {
    $this->matcher = $matcher;
    $this->resolver = $resolver;
    $this->resolverInterface = $resolverInterface;
  }

  public function handle(Request $request) {
    $this->matcher->getContext()->fromRequest($request);

    try {
      $request->attributes->add($this->matcher->match($request->getPathInfo()));

      $controller = $this->resolver->getController($request);

      $arguments = $this->resolverInterface->getArguments($request, $controller);

//      echo '<pre>';
//      echo print_r($arguments);
//      die;

      return call_user_func_array($controller, $arguments);
    } catch(ResourceNotFoundException $e) {
      return new Response('Not Found', 404);
    } catch(\Exception $e) {
      return new Response('An error occurred: '.$e->getMessage().'<br> File: '.$e->getFile().'<br> Line: '.$e->getLine(), 500);
    }
  }
}