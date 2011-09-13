# Ajax

If you wanted to make an Ajax call in TFD, it would return the full page source. This would break some requests, so an Ajax class was added to TFD.

## Making a Request

Inside of *content/_config/general.php* the "Magic Ajax Path" is defined. This is where all ajax calls should be made to. (default path is tfd-ajax/)

Ajax requests may be made one of two ways, first by adding a get parameter of *ajax* with the function you want to call:

	example.com/tfd-ajax/?ajax=function

Or as a path:

	example.com/tfd-ajax/function

Ajax calls may be made anywhere meaning that as long as the uri ends with *MAGIC_AJAX_PATH/[:any]* it will call the ajax class. That means this:

	example.com/tfd-ajax/call

Will return the same thing as:

	example.com/admin/tfd-ajax/call

## AJAX Class

The Ajax class file is located at *content/ajax/ajax.php*. Inside this file we have a call method, which is the brains of our ajax class.

### Call method

Our call method figures out what method or file it should call / load and then returns it.

Ajax functions can come from two different places. First it can come from another method of the ajax class (example is the test method (called by example.com/tfd-ajax/test) which returns 'foobar'):

	// content/ajax/ajax.php
	
	class Ajax extends TFD{
	
		function call(){
			...
		}
		
		function test(){
			return 'foobar';
		}
	
	}

To add your own, simply add a new function() after test (or replace test).

	// ajax.php
	
	class Ajax extends TFD{
	
		function call(){
			...
		}
		
		function test(){
			...
		}
		
		function your_call(){
			// do some work
			return $result;
		}
	
	}

Second, it could come from a file within the ajax directory.

	// content/ajax/foobar.php
	
	<?php
		// do some work here
		echo $result;
	?>

And then call *example.com/tfd-ajax/foobar*. This will return $result.

### Notes

* Methods take precedence over files, so if you have a method named *foobar* and a file named *foobar*, it will load the method and not the file.
* Reserved method / file names:
  * ajax
  * call
  * this
  * self