<?php

require_once __DIR__.'/vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Filesystem\Filesystem;
use Mni\FrontYAML\Parser;
use Michelf\MarkdownExtra;

$app = new Application();
$app['debug'] = false;

$app['contentDir'] = __DIR__ . '/app/content';

$app['config'] = array(
    'template' => 'default',
    'title'    => 'Simple Wiki',
);

$app['users'] = array(
    'admin' => '$2y$10$7KQSYuRdW.T6Ls92lW7GAeq/zkbEYYm9RJ5HzK50Cl9EsZVDszaJ2', # admin:admin
);

$app->register(new TwigServiceProvider(), array(
    'twig.path'    => __DIR__.'/app/views',
    'twig.options' => array(
        'strict_variables' => false,
    )
));

$app->register(new SessionServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new RedirectServiceProvider());
$app->register(new FlashServiceProvider());

$app['filesystem'] = $app->share(function() {
    return new Filesystem;
});

$app['parser'] = $app->share(function() {
    return new Parser();
});

$app['findFile'] = $app->protect(function($page) use ($app) {
    $files = $app['filesystem']->glob($app['contentDir'] . '/' . $page . '.*');
    if (!$files) {
        return false;
    }
    return $files[0];
});

$app['render'] = $app->protect(function($file) use ($app) {
    $raw = $app['filesystem']->get($file);
    $document = $app['parser']->parse($raw, false);
    $config = $app['config'];
    if (is_array($document->getYAML())) {
        $config = array_merge($config, $document->getYAML());
    }
    if ($app['session']->has('user')) {
        $config = array_merge($config, $app['session']->get('user'));
        $config['markdown'] = $raw;
    }
    $config['content'] = MarkdownExtra::defaultTransform($document->getContent());
    return $app['twig']->render($config['template'] . '.twig', $config);
});

$app->get('/login', function() use ($app) {
    return $app['twig']->render('login.twig');
})->bind('login');

$app->post('/login', function(Request $request) use ($app) {
    $username = $request->get('username');
    $password = $request->get('password');
    if (isset($app['users'][$username]) && password_verify($password, $app['users'][$username])) {
        $app['session']->set('user', array(
            'username'  => $username,
            'logged_in' => true,
        ));
        return $app['redirect.route']('page', array('page' => 'index'));
    } else {
        $app['flash']->error('Invalid username/password');
        return $app['redirect.route']('login');
    }
});

$app->get('/logout', function() use ($app) {
    $app['session']->clear();
    return $app['redirect.route']('page', array('page' => 'index'));
})->bind('logout');

$app->get('/{page}', function(Request $request, $page) use ($app) {
    $file = $app['findFile']($page);
    if (!$file) {
        return $app->abort(404);
    }
    return $app['render']($file);
})
->bind('page')
->value('page', 'index')
->assert('page', '.+');

$app->post('/{page}', function(Request $request, $page) use ($app) {
    if (!$app['session']->has('user')) {
        $app['flash']->error('Must be logged in to do that.');
        $app['redirect.route']('login');
    }
    $file = $app['findFile']($page);
    if (!$file) {
        # New file
        $file = $app['contentDir'] . '/' . $page . '.md';
        # Make sure directory exists
        $dirname = dirname($file);
        if (!$app['filesystem']->isDirectory($dirname)) {
            $app['filesystem']->makeDirectory($dirname);
        }
    }
    $app['filesystem']->put($file, str_replace("\r\n", "\n", $request->get('content')));
    return $app['redirect.route']('page', array('page' => $page));
})
->value('page', 'index')
->assert('page', '.+');

if (php_sapi_name() !== 'cli') {
    Request::enableHttpMethodParameterOverride();
    $app->run();
} elseif ($argv[1] === 'genpass') {
    echo password_hash($argv[2], PASSWORD_BCRYPT, array("cost" => 10)) . PHP_EOL;
} else {
    $app->boot();
}
