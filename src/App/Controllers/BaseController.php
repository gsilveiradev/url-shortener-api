<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }
}
