# JavaScript

This is an experimental library that is in active development. It allows you to load scripts, functions, and call functions on dom ready.

## echo_scripts

Echos out all the scripts you have added using this class.

### Syntax

	$this->javascript->echo_scripts();

### Parameters:

* none

### Return

* (*string*) echos out all the &lt;scripts loaded

### Example:

	// no need to echo, it does it for you
	$this->javascript->echo_scripts();

## add_library

Add another library to the JS class for easy loading.

### Syntax

	$this->javascript->add_library(name, source, load, order);

### Parameters:

* **name** - (*string*) give the library a friendly name to call it by later
* **source** - (*string*) the location of the script, could be local or on a CDN
* load - (*boolean*) if true will load the library (default false)
* order - (*integer*) order of the script in the load array

### Returns

* (*null*)

### Example:

	$this->javascript->add_library('labjs', 'http://ajax.cdnjs.com/ajax/libs/labjs/1.2.0/LAB.min.js');
	// and then call it later
	$this->javascript->library('labjs');
	// or to load it as well as add it
	$this->javascript->add_library('labjs', 'http://ajax.cdnjs.com/ajax/libs/labjs/1.2.0/LAB.min.js', true);

### Current Libraries:

* MooTools
* MooTools More
* jQuery
* jQuery UI

## library

Load a library.

### Syntax

	$this->javascript->library(name, load, order);

### Parameters:

* **name** - (*string*) the name of the library to load
* load - (*boolean*) load the library
* order - (*integer*) the order of the script in the load array

### Returns

* (*boolean*) true if a library was loaded

### Example:

	$this->javascript->library('mootools');
	$this->javascript->library('mootools-more');
	if(!$this->javascript->library('custom-lib')){
		// load library
	}

## load

Load a script (or scripts).

### Syntax

	$this->javascript->load(source, order);

### Parameters:

* **source** - (*string* or *array*) the location of the script(s)
* order - (*integer*) the order of the script in the load array

### Returns

* (*null*)

### Example:

	// load single script
	$this->javascript->load('js/foo.js');
	// or load multiple scripts
	$scripts = array('js/foo.js', 'js/bar.js');
	$this->javascript->load($scripts);

## script

Functions, vars, etc that go outside the dom ready function

### Syntax

	$this->javascript->script(code, order);

### Parameters:

* **code** - (*string*) the javascript code
* order - (*integer*) the order of the script in the load array

### Returns

* (*null*)

### Example:

	// no need to wrap in script tags, echo_scripts does that for you
	$this->javascript->script('console.log("hello world");');
	$script = <<<JS
	var foo = 'bar';
	function alertFoo(){
		alert(foo);
	}
	JS;
	$this->javascript->script($script);

## ready

Code to go inside the dom ready function

### Syntax

	$this->javascript->ready(code, order);

### Parameters:

* **code** - (*string*) the javascript code
* order - (*integer*) the order of the script in the load array

### Returns

* (*null*)

### Example:

	$this->javascript->ready('console.log("mootools ready");');
	$ready = <<<READY
		alertFoo();
	READY;
	$this->javascript->ready($ready);

# Examples

	// load mootools
	$this->javascript->library('mootools');
	// add a function outside the dom ready function
	$script = <<<SCRIPT
	var foo = 'bar';
	function alertFoo(){
		alert(foo);
	}
	SCRIPT;
	$this->javascript->script($script);
	// now add something to the ready function
	$this->javascript->ready('alertFoo();');

The above code will output:

	<script src="js/mootools-core-1.3.1.min.js"></script>
	<script>
	var foo = 'bar';
	function alertFoo(){
	 	alert(foo);
	}
	window.addEvent('domready',function(){
	alertFoo();
	});
	</script>