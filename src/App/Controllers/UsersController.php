<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends BaseController
{
    public function __construct($app, $service)
    {
        parent::__construct($app, $service);
    }

    public function urls($id)
    {
        $username = $id;

        // Verify user
        $user = $this->service->getOne($username);
        if ($user === false) {
            return new JsonResponse(false, Response::HTTP_NOT_FOUND);
        }

        $topUrls = [];

        $urls = $this->service->getUrlsStatsByUser($user['id']);
        foreach ($urls as $url) {
            $topUrls[] = [
                'id' => $url['id'],
                'hits' => $url['hits'],
                'url' => $url['url'],
                'shortUrl' => $this->app['api_url'].'urls/'.$url['hash']
            ];
        }

        $urlsCount = $this->service->getUrlsStatsCountByUser($user['id']);

        return new JsonResponse([
            'id' => $user['username'],
            'urls' => [
                'hits' => $urlsCount['hits_sum'] ? $urlsCount['hits_sum'] : 0,
                'urlCount' => $urlsCount['url_count'] ? $urlsCount['url_count'] : 0,
                'topUrls' => $topUrls
            ]
        ]);
    }

    public function store(Request $request)
    {
        $username = $request->request->get('id');

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
            return new JsonResponse(false, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($this->service->delete($user['id']));
    }
}
