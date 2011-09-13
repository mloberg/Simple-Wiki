# Admin

These are some of the public methods offered by the admin class. The admin class is also in charge of all the backend stuff and includes a lot of private methods.

## loggedin

See if the current user is logged in.

### Syntax

	$this->admin->loggedin();

### Parameters

* none

### Returns

* (*boolean*) true if user is logged in

### Example:

	if($this->admin->loggedin()){
		// user is logged in
	}

## logout

Logs the current user out.

### Syntax

	$this->admin->logout();

### Parameters

* none

### Returns

* (*null*) redirects to the homepage after deleting session info

## add_user

Add a user to a database.

### Syntax

	$this->admin->add_user(username, password, info);

### Parameters

* **username** - (*string*) User's username
* **password** - (*string*) raw string that will be turned into hashed password
* info - (*array*) - other user info (if you have other rows on your user table)

### Returns

* (*boolean*) true if user was added to database

### Example:

	$username = 'user';
	$password = 'password';
	if($this->admin->add_user($username, $password)){
		// user added successfully!
	}else{
		// something went wrong
	}
	// add some custom data
	$info = array(
		'permissions' => '1',
		'name' => $name
	);
	$this->admin->add_user($username, $password, $info);

## hash_pass

Turn a string into a hashed value

### Syntax

	$this->admin->hash_pass(password);

### Parameters

* **password** - (*string*) string you want to be hashed

### Returns

* (*string*) hashed string of password

### Example:

	$password = 'mySecretPassword';
	$hashed = $this->admin->hash_pass($password);