# Error

This is a wrapper class for php error reporting functions.

## log_error

Log the error to *error.log*.

### Syntax

	$this->error->log_error(error, die, die_message);

### Parameters

* **error** - (*string*) the error to log
* die - (*boolean*) die after logging the error (default null)
* die_message - (*string*) the message to display after dying (default "Something went wrong.")

### Returns

* (*null*)

### Example

	$this->error->log_error('Something bad happened.');
	if(!$foo){
		$this->error->log_error('Could not find foo!', true, 'No foo...');
	}

### Notes

If die is false will not return anything, if true will return the die_message, if null and $this->testing is true will return die_message

## report

Report the error to the screen without logging it.

### Syntax

	$this->error->report(error, die);

### Parameters

* **error** - (*string*) the error to report
* die - (*boolean*) die after report the error (default false)

### Returns

* (*null*)

### Example

	$this->error->report('This is an error.');
	if(!$foo){
		$this->error->report('No foo!', true);
	}

### Notes

If in testing mode, will always die.

## email

Email the error to the ADMIN_EMAIL.

### Syntax

	$this->error->email(error, report);

### Parameters

* **error** - (*string*) the error to email
* report - (*boolean*) display the error on screen and die (default false)

### Returns

* (*null*)

### Example

	$this->error->email('This must be a pretty serious error to email.');
	if(!$foo){
		$this->error->email('No foo!', true);
	}

### Notes

If you are in testing mode and report is set to true, it will not die after reporting the error.