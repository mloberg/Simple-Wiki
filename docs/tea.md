# Tea

Tea is TFD's Command Line Interface that was added in version 1.5. It allows you to setup a new copy of TFD with just a couple of commands, add users to the database, change the database schema, or even generate [database migrations](tea/migrations).

## Installing Tea

Installing Tea takes just one command.

	curl get.teafueleddoes.com/tea | sh

After installing Tea, you can install a new TFD application.

## Install TFD using Tea

Installing TFD is incredibly simple once you have Tea installed.

	tea create site_name

This command will download the latest copy and save it to the folder you specified.

## Tea Init

Once you have TFD installed, you can run *tea init* and it will setup your users table, add a user to it, create any other tables you need, and setup migrations.

## Tea Classes

Once you are in a TFD directory, Tea has a ton more commands available to it. They are broken down into these classes.

### General

The [general class](tea/general) mainly deals with config options.

	tea general
	// or
	tea -g

### User

The [user class](tea/user) deals with adding and editing users in your database.

	tea user
	// or
	tea -u

### Database

The [database class](tea/database) deals with changes to your database, this works hand in hand with the [migrations class](tea/migrations) if it's enabled.

### Migrations


