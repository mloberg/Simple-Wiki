<?php

use Silex\Application;
use Silex\ServiceProviderInterface;

class FlashServiceProvider implements ServiceProviderInterface
{

    public function register(Application $app)
    {
        $app['flash'] = $app->share(function() use ($app) {
            $flash = new Flash($app);
            return $flash;
        });
    }

    public function boot(Application $app)
    {
    }

}
