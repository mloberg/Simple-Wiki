# Partials

If you have an item that shows up again and again over your site, but not frequent enough (or you need to do some logic) to include in your master file, you can use a partial.

A partial is part of a web page. It differs from a [template](templates) in that it can have php and do logic.

Partials are found in *content/partials/*.

## partial

Render a partial.

### Syntax

	$this->partial(page, extra);

### Parameters:

* **options** (*string*) if string, the partial to render, otherwise an array of options
* extra - (*array*) 

### Returns

* (*string*) rendered html of partial

### Example:

	// a simple partial with no variables being passed
	echo $this->partial('form');
	
	// a more complex partial
	
	// content/partials/partial.php
	<?php
		echo $test;
	?>
	
	// code to echo partial
	
	echo $this->partial('partial', array('test' => 'foobar'));
	
	// would render
	foobar