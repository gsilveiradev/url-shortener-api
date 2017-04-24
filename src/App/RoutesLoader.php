<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();
    }

    private function instantiateControllers()
    {
        $this->app['urls.controller'] = function () {
            return new Controllers\UrlsController($this->app, $this->app['urls.service']);
        };

        $this->app['users.controller'] = function () {
            return new Controllers\UsersController($this->app, $this->app['users.service']);
        };
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/urls/{hash}', 'urls.controller:redirect');
        $api->get('/stats', 'urls.controller:index');
        $api->get('/stats/{id}', 'urls.controller:show');
        $api->delete('/urls/{id}', 'urls.controller:delete');

        $api->post('/users/{id}/urls', 'urls.controller:store');

        $api->get('/users/{id}/stats', 'users.controller:urls');
        $api->post('/users', 'users.controller:store');
        $api->delete('/users/{id}', 'users.controller:delete');

        $this->app->mount('', $api);
    }
}
