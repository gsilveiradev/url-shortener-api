<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Silex\Application;

class BaseController
{
    protected $service;
    protected $app;

    public function __construct(Application $app, $service)
    {
        $this->app = $app;
        $this->service = $service;
    }
}
