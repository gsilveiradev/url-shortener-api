<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }
}
