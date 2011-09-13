# Load

To load a helper or abstract class, use the load function.

## load

Load a file.

### Syntax

	$this->load(name);

### Parameters

* **name** - (*string*) file name (don't need directory or extension)

### Returns

* (*boolean*) true if file was loaded

### Example

	if($this->load('elements')){
		echo html::p('Elements class loaded.');
	}