# Hooks

Allows you to "hook" into core methods. File located at *content/hooks.php*

## Initialize

This hook is called right when the site method is called.

### Useful for:

* checking to see if a user is logged in
* pre-load a [script](javascript) or [stylesheet](css)

### Example:

	function initialize(){
		$this->css->add_sheet('jquery-ui-style', 'css/jqueryui/custom.css');
	}

## Render

This hook is called when the render function is called.

### Useful for:

* Loading a [script](javascript) or [stylesheet](css)

### Example:

	function render(){
		$this->css->load('jquery-ui-style');
	}

## admin

Called whenever an admin page is rendered.

### Useful for:

* loading admin specific stylesheets or scripts

### Example:

	function admin(){
		$this->css->load('css/admin.css');
	}

## Login

This method is called when a user is validated when logging in. This method gets passed the user information, retrieved from the database.

### Useful for:

* Adding extra user information to a cookie or session

### Example:

	function login($user){
		// $user is an array of user information from the database
		$_SESSION['username'] = $user['username'];
	}

## Logout

### Called when a user logouts.

* clearing cookie or session information

### Example

	function logout(){
		setcookie('some_cookie_you_set', '', time() - 3600);
	}