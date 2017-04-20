<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UrlsController extends BaseController
{
    public function __construct($service)
    {
        parent::__construct($service);
    }

    public function redirect($id)
    {
        return new JsonResponse(array("Redirect to URL: {$id}"));
    }

    public function store($id)
    {
        return new JsonResponse(array("Store URL for user: {$id}"), Response::HTTP_CREATED);
    }

    public function index()
    {
        return new JsonResponse(array("Stats of all URLs."));
    }

    public function show($id)
    {
        return new JsonResponse(array("Stats of one URL: {$id}"));
    }

    public function delete($id)
    {
        return new JsonResponse(array("Delete URL: {$id}"));
    }
}
