<?php

namespace App;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function bindServicesIntoContainer()
    {
        $this->app['urls.service'] = function () {
            return new Services\UrlsService($this->app['db']);
        };

        $this->app['users.service'] = function () {
            return new Services\UsersService($this->app['db']);
        };
    }
}
