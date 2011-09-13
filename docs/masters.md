# Masters

A web site will usually have the same basic design on every page with just the content on the page changing. Because TFD aims to be DRY, the [render engine](render-engine) implements "masters". Masters are containers for [pages](pages). They contain the overall page structure.

## Default master files

TFD includes 4 default master files. The default, admin, 404, and maintenance.

### Default

This is the master that is loaded by default. If no master is specified or the called master doesn't exist, TFD uses this master.

### Admin

The admin master is the master file that is used for the backend (any file within *content/admin-dashboard/* or loaded using the *"admin" : true* route).

### 404

If TFD encounters a 404, this master is loaded.

### Maintenance

If TFD is in [maintenance mode](maintenance), this master will be loaded.

## Creating Your Own Masters

If you need more then one master for your site, TFD allows you to do that. In fact, you can have as many as you want.

To create a new master, simple create a php file within *content/masters/* and then in your page, call that master.

## Passing Variables

[Pages](pages) and masters can talk to each other by use of variables (just plain old php $variables).

### Default Variables

* title - the page title (if none passed defaults to site title set in [config](config))
* master - the master to use

### Custom Variables

Along with the default variables, you can define your own variables.

	// in page
	<?php $foo = 'bar';?>
	
	// in master
	...
	<?php echo $foo;?>
	...
	
	// will render out
	...
	bar
	...

### Reserved variable names

These are reserved variable names in TFD (all php reserved variables will apply as well).

* *content*
* *dir*
* *file*
* *admin*
* *page*

## Default Variables/Methods

If you take a look at *content/masters/master.php* you can see that are some variables and methods mixed in to the html.

### title

Display the title (either one that's set or the default site title)

	<title><?php echo $title;?></title>

### content

This is where the page is rendered to.

	<?php echo $content;?>

### $this->css->echo_stylesheets()

This is where all the stylesheets loaded using TFD's [CSS Class](css), will be rendered to.

### $this->flash->render()

This is where any flash messages will be rendered to.

### $this->javascript->echo_scripts()

This is where all the scripts loaded using TFD's [JavaScript Class](javascript) will be rendered to.

## Default Master Example

Here is what the default master looks like

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title;?></title>
		<?php $this->css->echo_stylesheets();?>
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
	<?php echo $this->flash->render();?>
	<div id="wrapper">
	<?php echo $content;?>
	
	</div>
	<?php $this->javascript->echo_scripts();?>
	</body>
	</html>