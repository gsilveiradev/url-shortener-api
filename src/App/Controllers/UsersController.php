<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends BaseController
{
    public function __construct($service)
    {
        parent::__construct($service);
    }

    public function urls($id)
    {
        return new JsonResponse(array("Get URLs from user: {$id}"));
    }

    public function store()
    {
        return new JsonResponse(array("Store User."), Response::HTTP_CREATED);
    }

    public function delete($id)
    {
        return new JsonResponse(array("Delete User: {$id}"));
    }
}
