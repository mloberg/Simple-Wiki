# Models

Models are collections of code that you use all over the site. This helps TFD stay DRY.

## Creating a model

Creating a model is simple. Just create a file within *content/models/*, create a class with the same name of the file that extends Model, and add some methods.

### Example

	// content/models/foo.php
	<?php
	
		class Foo extends Model{
		
			function __construct(){
				parent::__construct();
			}
			
			function bar(){
				return 'foobar';
			}
		
		}

## Calling a model

Calling a model is pretty simple as well.

### Syntax

	$this->model->model_name->method();

### Example

So taking our above example, if we wanted to call our bar method, we would do this:

	echo $this->model->foo->bar(); // "foobar"