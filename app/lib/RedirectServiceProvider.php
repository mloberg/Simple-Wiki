<?php

use Silex\Application;
use Silex\ServiceProviderInterface;

class RedirectServiceProvider implements ServiceProviderInterface
{

    public function register(Application $app)
    {
        $app['redirect.route'] = $app->protect(function($route, $parameters = array()) use ($app) {
            return $app->redirect($app['url_generator']->generate($route, $parameters));
        });
    }

    public function boot(Application $app)
    {
    }

}
