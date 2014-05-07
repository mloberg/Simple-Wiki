# Simple Wiki

Simple Wiki is a lightweight, database-less wiki written in PHP. It's goal is to be easy to install and edit pages. It uses Silex, Twig, and Markdown.

## Installing

### 1) Getting Simple Wiki

If you have git installed:

	git clone git@github.com:mloberg/Simple-Wiki.git

If you don't have git or don't know, you can [download the zip here.](https://github.com/mloberg/Simple-Wiki/zipball/master)

### 2) Edit your config

After you have a copy of Simple Wiki, you need to edit the config in *config/config.php*.

Here you can set your site title, url, and any admin users.

### 3) Start editing your wiki

Once you have an admin user setup, you can login and start editing pages. Pages have support for [Markdown](http://daringfireball.net/projects/markdown/).

## Adding A Page

To add a page you can either click on the Add Page link in the footer once you have logged in, or simply go to the path of the page you want and click "Add this page".

## Issues

If you are having issues editing or adding pages, you may need to change some file permissions.

	chmod 777 docs
	chmod 777 includes
