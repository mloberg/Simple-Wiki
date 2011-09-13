# Structure

Tea-Fueled Does is split up into three main folders: public, content, and tfd (or the core).

## Public

This is the only folder that needs to be in the public directory. It includes two essential files and then all your css, js, and image files.

### .htaccess

Your .htaccess file does a couple of things.

* Sets up what [environment](environments) it should use.
* Points all requests ending in (css, js, img, images, font, fonts) to their respective folder.
* It points all requests (except for files/folders that actually exist) to index.php.
* Protects your *content* and *tfd* folders if they are inside of the directory.

### Index.php

This is our main file, it gets the ball rolling. It includes our main config file, which includes all the necessary files. It then echos out the site.

Inside this file there are two variables that you must set, *$app_dir* and *$content_dir*. These are the relative paths to the tfd folder and content folder.

## Content

This is the folder you will spend all your time in. Inside here are all your pages, and logic files.

### _config

These are your config files. Any file you have in here, will be loaded before anything is sent to the screen.

#### Read More

* [Config](config)

### admin-dashboard

This folder contains all the templates for the admin dashboard or the admin protected part of the site.

#### Read More

* [Admin](admin)
* [Render Engine](render-engine)
* [Pages](pages)
* [Masters](masters)

### admin-www

This is the public admin directory. Includes the login and signup forms.

### Read More

* [Render Engine](render-engine)
* [Pages](pages)

### ajax

Ajax folder. Includes the ajax class and any ajax files.

#### Read More

* [Ajax](ajax)

### hooks.php

Hooks allow you to "hook" into TFD functions.

#### Read More

* [Hooks](hooks)

### masters

These files are your main page templates.

#### Read More

* [Masters](masters)
* [Render Engine](render-engine)

### models

Collections of code. Very similar to CodeIgniter models.

#### Read More

* [Models](models)

### partials

Parts of pages you can call to render to the page. Useful if you have a form or something that appears on the site on multiple pages.

#### Read More

* [Partials](partials)

### routes.json

Routes allow you to control urls.

#### Read More

* [Routes](routes)

### www

Public page templates.

#### Read More

* [Pages](pages)
* [Render Engine](render-engine)

## TFD

This is the core folder. There is no reason you should have to edit anything in this folder.