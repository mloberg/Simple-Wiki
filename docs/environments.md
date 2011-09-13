# Environments

When developing a website/web app, you'll likely have a couple of different machines you work with. One for development, one for testing and the production or live server. For each of these you'll have a different database, url, and other settings. Instead of having to redefine each of these settings every time you push updates to another server, TFD has environments where you can set each of these settings.

The environment settings are located in *content/_config/environments.php*.

## Controlling Environments

Environments are set using .htaccess

	SetEnv ENV DEVELOPMENT

For each server change DEVELOPMENT to whatever environment you want it to be.

### git and TFD

If you are using git to push changes to your servers, make sure you add *public/.htaccess* to your .gitignore file so the environment is being overwritten every time you pull a change.

## Environment Settings

Inside of our environments config file, you will find an else if statement that has three default environments (development, testing, and production). Each environment has these default settings.

### Base URL

Each instance of you app will be hosted on a different server, and therefore have a different url. Since BASE_URL is a essential to TFD working properly, this must be set (and include the trailing slash /)

### PHP Error Reporting

Set PHP's error reporting level.

### Testing Mode

This is for use with TFD's [error class](error). It can also be used for [testing](testing) features.

### Add User

If true, you have the ability to add a user to the database using a url. (example.com/?add_user&username=user&password=pass).

### Database Settings

Set your MySQL host, username, password, and database.

### Custom Settings

You can also set up your own settings.

## Making A Custom Environment

The great thing about this environments file is that you can set your own environments up. Let's say you have multiple developers working on it each with their own local setup. Chances are they won't all have the same information, so you can set up a different development environment for each of them.

To add an environment, simply extend the else if statement:

	...
	}elseif(ENVIRONMENT === 'PRODUCTION'){
		...
	}elseif(ENVIRONMENT === 'MATT_TESTING'){
		// your local environment info
	}

And then change your environment in .htaccess to match your new environment.