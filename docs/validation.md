# Validation

Validate information.

**Note:** There is a new and better [Validation class](validate), that I recommend over this one.

## test

After adding rules, test those rules.

### Syntax

	$this->validation->test(text);

### Parameters

* **text** - (*string*) the text you want to test

### Returns

* (*boolean*) true if it does not pass

### Example

	// using some rules below
	if($this->validation->email()->test($_POST['email'])){
		echo 'invalid email address';
	}

## email

Test for a valid email.

### Syntax

	$this->validation->email()

### Parameters

* none

### Returns

* (*null*)

### Example

	$this->validation->email()->test($_POST['email']);

## max_len

Max length

### Syntax

	$this->validation->max_len(int)

### Parameters

* **int** - (*integer*) max length

### Returns

* (*null*)

### Example

	$this->validation->max_len(5)->test($_POST['zip']);

## min_len

Min length

### Syntax

	$this->validation->min_len(int)

### Parameters

* **int** - (*integer*) min length

### Returns

* (*null*)

### Example

	$this->validation->min_len(5)->test($_POST['zip']);

## req

Required (not empty including extra spaces)

### Syntax

	$this->validation->req()

### Parameters

* none

### Returns

* (*null*)

### Example

	$this->validation->req()->test($_POST['name']);

## match

match a string exactly

### Syntax

	$this->validation->match(match)

### Parameters

* **match** - (*string*) string to match

### Returns

* (*null*)

### Example

	$this->validation->match($_POST['password_conf'])->test($_POST['password']);