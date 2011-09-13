# Geneneral

Tea's general class allows you to make changes to some config options.

## Auth Key

Generate a new auth key. This will force all users to revalidate their account (login again).

	tea general auth_key
	tea general -a

## Maintenance Mode

Turn [maintenance mode](maintenance) on or off.

	tea general maintenance [on|off]
	tea general -m [on|off]
