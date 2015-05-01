# Simple Wiki

Simple Wiki is a database-less wiki. It renders pages from Markdown and allows
you to add and edit pages from the web application.

## Installing

If you have [Composer](https://getcomposer.org) installed you can use the
`create-project` command to install Simple Wiki.

    composer create-project mlo/simple-wiki path/to/project

## Configuring

Simple Wiki allows you to edit your pages through the web application if an
user is logged in. Users are defined in `index.php`.

    $app['users'] = array(
        'username' => 'bcrypted password',
    );

To generate a bcrypted password run `php index.php genpass [password]`.

## Pages

Pages are stored in `app/content`, but can be changed using the `contentDir`
setting. These pages are Markdown files with support for YAML Front Matter.

    ---
    title: Page Title
    ---
    Page content

## Running

You can run Simple Wiki locally using PHP's built in web server (PHP >=5.4).

    php -S 127.0.0.1:4000 -t web server.php

## Hacking

Simple Wiki is built using Silex and Twig and can be modified to fit your needs.

If you add something cool, create a pull request for it.
