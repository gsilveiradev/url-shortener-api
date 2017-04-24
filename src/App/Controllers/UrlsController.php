<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Hashids\Hashids;

class UrlsController extends BaseController
{
    protected $userService;

    public function __construct($service)
    {
        parent::__construct($service);
    }

    public function redirect($id)
    {
        return new JsonResponse(array("Redirect to URL: {$id}"));
    }

    public function store($id, Request $request)
    {
        $username = $id;
        $url = $request->request->get("url");

        // Verify params
        if (!$username || !$url) {
            return new JsonResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Verify user
        $user = $this->service->getOneUser($username);
        if ($user === false) {
            return new JsonResponse(false, Response::HTTP_CONFLICT);
        }

        $urlId = $this->service->save([
            'user_id' => $user["id"],
            'hits' => 0,
            'url' => $url,
            'hash' => $url
        ]);

        $hashids = new Hashids();

        $this->service->update($urlId, ['hash' => $hashids->encode($urlId)]);
        $url = $this->service->getOne($urlId);

        return new JsonResponse([
            "id" => $url['id'],
            "hits" => $url['hits'],
            "url" => $url['url'],
            "shortUrl" => $url['hash']
        ], Response::HTTP_CREATED);
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
