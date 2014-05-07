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
$app['debug'] = true;

$app['config'] = array(
    'template' => 'default',
    'title'    => 'Simple Wiki',
);

$app->register(new TwigServiceProvider(), array(
    'twig.path'    => __DIR__.'/_templates',
    'twig.options' => array(
        'strict_variables' => false,
    )
));

$app->register(new SessionServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

$app['filesystem'] = $app->share(function() {
    return new Filesystem;
});

$app['parser'] = $app->share(function() {
    return new Parser();
});

$app['render'] = $app->protect(function($file) use($app) {
    $raw = $app['filesystem']->get($file);
    $document = $app['parser']->parse($raw, false);
    $config = array_merge($app['config'], $document->getYAML());
    $config['content'] = MarkdownExtra::defaultTransform($document->getContent());
    return $app['twig']->render($config['template'] . '.twig', $config);
});

$app->get('/{page}', function(Request $request, $page) use ($app) {
    // Find a match
    $files = glob('_content/' . $page . '.*');
    if (!$files) {
        $app->abort(404);
    } else {
        $file = $files[0];
    }
    return $app['render']($file);
})
->bind('page')
->value('page', 'index')
->assert('page', '.+');

if (php_sapi_name() !== 'cli') {
    Request::enableHttpMethodParameterOverride();
    $app->run();
} else {
    $app->boot();
}
