<?php

namespace Books\Controller;

use Symfony\Component\HttpFoundation\Response;
use Books\Model\Books;

/**
 * Created by PhpStorm.
 * User: workstation-php
 * Date: 16.03.17
 * Time: 13:11
 */
class BooksController {
  public function indexAction($page, $test) {
    $model = new Books();

    $data = $model->getList();

    echo '<pre>';
    echo print_r($data);
    return new Response($page . ' ' . $test);
  }
}