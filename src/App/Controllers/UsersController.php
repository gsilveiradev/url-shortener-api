<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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

    public function store(Request $request)
    {
        $username = $request->request->get("id");

        // Verify params
        if (!$username) {
            return new JsonResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Verify duplicates
        if ($this->service->getOne($username) !== false) {
            return new JsonResponse(false, Response::HTTP_CONFLICT);
        }

        $user = $this->service->save(['username' => $username]);
        $user = $this->service->getOne($username);

        return new JsonResponse(['id' => $user['username']], Response::HTTP_CREATED);
    }

    public function delete($id)
    {
        // Verify user
        $user = $this->service->getOne($id);

        if ($user === false) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($this->service->delete($user['id']));
    }
}
