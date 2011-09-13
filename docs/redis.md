# Redis

[Redis](http://redis.io/) is a key-value store. This class is based off of [iRedis](https://github.com/dhorrigan/iRedis) and allows you to communicate with a Redis server.

## Configuration

All configuration settings are found in *content/_config/redis.php*. Just like the [environments config file](environments), you have multiple environments settings.

Just set the Redis host and port (default 6379), and if you set Redis up with a password, the password and you're ready to use this class.

## Sending Redis Commands

Communicating with Redis is simple. You don't need to open a connection manually, or even send the auth command if you have a password. Just send the command and the class will set up the connection with your server and do any needed authentication.

This class and take any [Redis command](http://redis.io/commands) as a method, so instead of going over each Redis command, I'll go over the basic usage of this class.  

### Syntax

	$this->redis->command(options)

### Parameters

* **command** - incr, decr, or any other [Redis command](http://redis.io/commands)
* options - any parameters the command requires

### Returns

* (*mixed*) array, string, integer, or null based on the command

### Example

	// set a redis key
	$this->redis->set('key:name', 'key-value');
	
	// get the key value
	echo $this->redis->get('key:name'); // key-value
	
	// delete the key
	$this->redis->del('key:name');
	
	// increase a key
	for($i = 0; $i < 10; $i++){
		$this->redis->incr('counter');
	}
	
	// decrease a key
	$this->redis->decr('counter');
	
	// get all keys
	$keys = $this->redis->keys('*'); // returns an array of all keys