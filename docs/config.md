# Config


## General

This is for your general site configuration.

### Maintenance Mode

Turn [Maintenance Mode](maintenance) on or off.

### Site Title

The title to use if no *$title* is set in the page.

### Admin Email

This is used for the [error class](error) to email errors.

### Login Path

Set the path where users will be able to login.

### Admin Path

Set the path where users will be able to access the admin panel after they have logged in.

### Users Table

The MySQL table where the user's log in information is stored (see [Getting Started](getting-started) Admin Setup for table structure and information).

### Auth Key

When a user logs in, a session fingerprint is created using some user information and this auth key. If the key changes, the user must re-login.

### Login Time

Set how long the user will stay logged in (3600 is an hour). This has no effect on sessions, so if a user doesn't close their browser or log out, they will stay logged in, no matter how long this is set.

### Magic Ajax Path

Set where ajax requests should be made to. (See [Ajax](ajax))

## API Keys

TFD supports some third party services which require API keys to use ([S3](amazon-s3), [Postmark](postmark), [ReCAPTCHA](recaptcha)). If you plan on using one of these services, set the API key and secret along with any other config options, and you can start using their respective library.

## Environments

See [Environments](environments).

## Redis

Set [Redis](redis) config options. Set up a lot like [environments](environments). Set the Redis host, port, and password (if a password is setup).

## Creating Your Own Config Options

All files within *content/_config/* are loaded on initialize. So if you need to set some of your own config options, simply create a new file in *content/_config* and set your options.