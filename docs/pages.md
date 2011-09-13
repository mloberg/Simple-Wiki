# Pages

Pages are the content of the site. They go hand and hand with [masters](masters).

## Creating a page

Creating a page in TFD is really simple, all you need to do is add it to *content/www* with the path you want the page to be at. (e.g. you want the page *example.com/about/history*, you would create the file *content/www/about/history.php*).

## Defining Masters

By default *content/masters/master.php* is the [master](masters) that's loaded. If we wanted to use another master (such as our custom *content/masters/home.php* for use with our homepage), we would simply add a *$master* variable.

	<?php $master = 'home';?>

This will tell TFD to use *content/masters/home.php* as the master file.

## Talking With Our Master

We can "talk" with our master by using variables. There are some default variables, and you can also define your own.

### Default Variables

#### Title

Set the page title:

	$title = 'About Us';

### Adding Your Own

Adding your own variable is as easy as

	$foo = 'bar';

You should then set up your [master](masters) to use the variable.

### Reserved Variables

These variables are reserved in TFD (all php reserved variables apply as well). Using one of these may cause unexpected results.

* *content*
* *dir*
* *file*
* *admin*
* *page*