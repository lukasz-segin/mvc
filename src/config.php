<?php

return [
  'database' => [
    'driver'  =>  'pdo_mysql',
    'user'    =>  'root',
    'password'=>  'root',
    'dbname'  =>  'mvc_5',
  ],

  'twig'  =>  [
    'dir'   =>  __DIR__,
    'cache' =>  __DIR__.'/../cache'
  ]
];