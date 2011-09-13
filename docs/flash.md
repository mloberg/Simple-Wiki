# Flash

Flash is a class that allows you to display a message to the current user.

## message

### Syntax

	$this->flash->message(message, type, options);

### Parameters

* **message** - (*string*) Message to display
* type - (*string*) type of message (error(default), warning, or success)
* options - (*array*)
  * time - (*integer*) time in seconds to display the message (default 2)
  * sticky - (*boolean*) if true, message will not fade out (default false)

### Returns

* (*null*)

### Example

	// error message
	$this->flash->message('Error Message');
	// or
	$this->flash->message('Error Message', 'error');
	// warning
	$this->flash->message('Warning Message', 'warning');
	// success
	$this->flash->message('Success Message', 'success');
	// a success message that displays for five seconds
	$this->flash->message('Success message', 'success', array('time' => 5));
	// an error message that does not fade out
	$this->flash->message('Error Message', 'error', array('sticky' => true));

## redirect

Display a flash after a redirect.

### Syntax

	$this->flash->redirect(message, type, options);

### Parameters

* **message** - (*string*) Message to display
* type - (*string*) type of message (error(default), warning, or success)
* options - (*array*)
  * time - (*integer*) time in seconds to display the message (default 2)
  * sticky - (*boolean*) if true, message will not fade out (default false)

### Returns

* (*null*)

### Example

	$this->flash->redirect('Please Login To View This Page.', 'error');
	redirect('login');

## render

This will render out the css, and javascript for a flash, and then return the HTML.

### Syntax

	$this->flash->render();

### Parameters

* *none*

### Returns

* (*string*) - Flash HTML

### Example

	echo $this->flash->render();