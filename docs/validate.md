# Validate

A new and improved validation class to validate user information.

## Initializing

Create a new validate object.

### Syntax

	new Validate(text);

### Parameters

* text - (*string*) string of the text to validate

### Returns

* (*boolean*) returns true

### Example

	$validate = new Validate($_POST[\'name\']);

## Email

Test for a valid email.

### Syntax

	$validate_obj->email()

### Parameters

* none

### Returns

* (*boolean*) true if passed validation

### Example

	$validate = new Validate($_POST[\'email\']);
	
	if($validate->email()){
		echo \'valid email address\';
	}

## Max Length

Test for a max length

### Syntax

	$validate_obj->max_len(int)

### Parameters

* **int** - (*integer*) max length

### Returns

* (*boolean*) true if passed validation

### Example

	$validate = new Validate($_POST[\'text\']);
	
	if($validate->max_len(140)){
		echo $_POST[\'text\'];
	}

## Min length

Test for a min length

### Syntax

	$validate_obj->min_len(int)

### Parameters

* **int** - (*integer*) min length

### Returns

* (*boolean*) true if passed validation

### Example

	$validate = new Validate($_POST[\'name\']);
	
	if($validate->min_len(5)){
		// do something
	}

## Length

Test for string to be a certain length.

### Syntax

	$validate_obj->length(int)

### Parameters

* **int** - (*int*) length of string

### Returns

* (*boolean*) true if passed validation

### Example:

	$validate = new Validate($_POST[\'zip\']);
	
	if($validate->length(5)){
		echo \'Valid zip code length.\';
	}

## Required

Test for a string (clears extra spaces)

### Syntax

	$validate_obj->required()
	$validate_obj->req()

### Parameters

* none

### Returns

* (*boolean*) true if passed validation

### Example

	$validate = new Validate($_POST[\'name\']);
	
	if($validate->required()){
		// do something
	}

## Match

Match a string exactly

### Syntax

	$validate_obj->match(match)

### Parameters

* **match** - (*string*) string to match

### Returns

* (*boolean*) true if passed validation

### Example

	$validate = new Validate($_POST[\'password\']);
	
	if($validate->match($_POST[\'password_conf\'])){
		echo \'Passwords match!\';
	}

## Number

Check for string to be a number

### Syntax

	$validate_obj->number()

### Parameters

* none

### Returns

* (*boolean*) true if passed validation

### Example:

	$validate = new Validate($_POST[\'age\']);
	
	if($validate->number()){
		// do something
	}

## Clear

Clear validate object status.

### Syntax

	$validate_obj->clear(text)

### Parameters

* text - (*string*) if not empty, will change testing string

### Returns

* (*boolean*) true

### Example

	$validate = new Validate($_POST[\'name\']);
	
	if(!$validate->max_len(12)){
		if($validate->clear()->req()){
			// do something
		}
	}
	
	// test a new string
	
	if($validate->clear($_POST[\'address\'])->req()){
		// do something
	}

## Text

Test a new string.

### Syntax

	$validate_obj->text(text)

### Parameters

* **text** - (*string*) text you want to test

### Returns

* (*boolean*) whatever the validation status was before the text changed

### Example

	$validate = new Validate($_POST[\'name\']);
	
	if(!$validate->required()){
		echo \'Name is required\';
	}
	
	if($validate->text($_POST[\'email\'])->email()){
		echo \'Valid email.\';
	}

# Method Chaining

The Validate library is meant to allow method chaining, so you can test a string for multiple 

## Example

	$validate = new Validate($_POST[\'zip\']);
	
	if($validate->number()->length(5)){
		echo \'Valid zip code\';
	}
	
You could even validate a whole form with a single line (though it wouldn\'t be very useful for feedback).

	$validate = new Validate($_POST[\'fname\']);
	
	$validate->req()->text($_POST[\'lname\'])->req()->text($_POST[\'zip\'])->number()->length(5)->text($_POST[\'password\'])->match($_POST[\'password_conf\']);
	
	// you can also test the object itself
	if($validate){
		// passed
	}else{
		// failed
	}
