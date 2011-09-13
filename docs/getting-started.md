# Getting Started

There are 3 core folders to TFD. The content, public, and tfd folders. Each folder serves a different purpose:

* Content - Holds all the templates, models, anything you would edit.
* Public - Includes index.php and .htaccess which get the process start. Also includes all the other public folders such as css, js, and image.
* TFD - The core app folder. All core app files are in here. You shouldn't need to edit this folder.

(Read more about the TFD [structure](structure))

TFD is built so that both the core and content don't have to be in a public directory. This makes it much less prone to attacks. If your setup requires that you need to have all folders in the public directory, it can also be done that way.

## Quick Installation

Getting a copy of TFD running is incredibly easy if you have access to your command line.

1) Install [Tea](tea) by running* (will require admin access):

	curl get.teafueleddoes.com/tea | sh

*skip this step if you already have Tea installed

2) Install TFD

	tea create site

This will install a copy of TFD into *site/*

3) Edit your config

Edit your [Environment](environments) settings in *content/config.php* and set your Environment in *public/.htaccess*

4) Setup your database

To finish the setup process, run

	// in your tfd directory
	tea init

This will walk you through your database setup (users table, users) and [migrations](tea/migrations).

### Installation without command line access

Tea increases the speed and takes out all the work of setting up a TFD application, but if you don't have access to the command line, you can still use TFD.

1) Grab a copy of TFD

You can always the grab the latest copy [here](http://get.teafueleddoes.com/latest.tar.gz).

After you have downloaded it, uncompress it, and move it to your web directory.

2) Edit your config

If you moved *content* or *tfd* somewhere else besides right outside your public directory, you need to edit *index.php* inside your public directory, and tell it where to find these folders.

Then edit your [Environment](environments) settings in *content/config.php* and set your Environment in *public/.htaccess*.

3) Set up your database

If you are using the admin part of TFD at all, you'll need to add a table for users.

	CREATE TABLE `users` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `username` varchar(128) NOT NULL,
	  `salt` varchar(512) NOT NULL,
	  `secret` varchar(512) NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `username` (`username`)
	);

4) Add a user to the database

Instead of storing a raw password, TFD uses a hashed and salted password. This provides a lot of extra security, as if someone with database access could not extract the user's password.

This also makes adding a user to the database a bit difficult. To help with this, TFD has two ways of adding a user to the database. The first way is by using an [admin](admin) method called add_user and the second is by calling a url.

This second method requires that ADD_USER inside of the environments config is set to true. Then you need to setup your url to look like this *example.com/?add_user&username=user&password=pass* replacing user with the username you want, and pass with the password you want.

## Create a Page

Creating a page in TFD is simple. You don't have to create a route like you would for Rails (though that's an [option](routes) if so please), you don't have to create multiple files like you would in CodeIgniter. You simply create a new file inside of *content/www/* with the same name as the path you want to the file. (e.g. create *content/www/about.php* would be the page for *example.com/about*.

Read more about TFD's [Render Engine](render-engine), [Pages](pages), [Masters](masters), and [Routes](routes).

## Adding a page to the Admin Dashboard

Adding a page to the admin dashboard is just as easy. Follow the same directions, but instead of saving it in *content/www/* save it in *content/admin/*.

## Read More

* [Structure](structure)
* [Masters](masters)
* [Pages](pages)
* [Render Engine](render-engine)
* [Routes](routes)