<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Hashids\Hashids;

class UrlsController extends BaseController
{
    protected $userService;

    public function __construct($app, $service)
    {
        parent::__construct($app, $service);
    }

    public function redirect($hash)
    {
        // Verify url
        $url = $this->service->getOneByHash($hash);
        if ($url === false) {
            return new JsonResponse(false, Response::HTTP_NOT_FOUND);
        }

        // Increase hits
        $this->service->update($url['id'], ['hits' => $url['hits']+1]);

        return new RedirectResponse($url['url']);
    }

    public function store($id, Request $request)
    {
        $username = $id;
        $url = $request->request->get('url');

        // Verify params
        if (!$username || !$url) {
            return new JsonResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Verify user
        $user = $this->service->getOneUser($username);
        if ($user === false) {
            return new JsonResponse(false, Response::HTTP_NOT_FOUND);
        }

        $urlId = $this->service->save([
            'user_id' => $user['id'],
            'hits' => 0,
            'url' => $url,
            'hash' => $url
        ]);

        $hashids = new Hashids();

        $this->service->update($urlId, ['hash' => $hashids->encode($urlId)]);
        $url = $this->service->getOne($urlId);

        return new JsonResponse([
            'id' => $url['id'],
            'hits' => $url['hits'],
            'url' => $url['url'],
            'shortUrl' => $this->app['api_url'].'urls/'.$url['hash']
        ], Response::HTTP_CREATED);
    }

    public function index()
    {
        $topUrls = [];

        $urls = $this->service->getUrlsStats();
        foreach ($urls as $url) {
            $topUrls[] = [
                'id' => $url['id'],
                'hits' => $url['hits'],
                'url' => $url['url'],
                'shortUrl' => $this->app['api_url'].'urls/'.$url['hash']
            ];
        }

        $urlsCount = $this->service->getUrlsStatsCount();

        return new JsonResponse([
            'hits' => $urlsCount['hits_sum'] ? $urlsCount['hits_sum'] : 0,
            'urlCount' => $urlsCount['url_count'] ? $urlsCount['url_count'] : 0,
            'topUrls' => $topUrls
        ]);
    }

    public function show($id)
    {
        // Verify url
        $url = $this->service->getOne($id);
        if ($url === false) {
            return new JsonResponse(false, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'id' => $url['id'],
            'hits' => $url['hits'],
            'url' => $url['url'],
            'shortUrl' => $this->app['api_url'].'urls/'.$url['hash']
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        // Verify url
        $url = $this->service->getOne($id);
        if ($url === false) {
            return new JsonResponse(false, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($this->service->delete($url['id']));
    }
}
