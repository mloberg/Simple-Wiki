# Templates

Tea-Fueled Does includes a version of the [Mustache Template](http://mustache.github.com/) system (more specifically [Mustache.php](https://github.com/bobthecow/mustache.php)).

Changes from mustache.php:

* renamed to template.php (so it's called by $this->template rather then $this->mustache)
* renamed class name from Mustache to Template (same reason as above)
* render method accepts a file (found inside content/template)

# Mustache

Mustache is a pretty awesome template system. It uses double curly braces to render variables and includes some logic (even though it says it's logic-less). I recommend reading up on it more at [http://mustache.github.com/](http://mustache.github.com/)

## render

Render a Mustache template.

### Syntax

	$this->template->render(template, values)

### Parameters

* **template** - (*string*) mustache template (file or string)
* values - (*array*) values to be replaced

### Returns

* (*string*) rendered html

### Example:

	// from a string
	$mustache = '<h1>Hello {{name}}!</h1>';
	$values = array(
		'name' => 'World'
	);
	echo $this->template->render($mustache, $values); // <h1>Hello World!</h1>
	
	// content/templates/foo.html
	<h1>Hello {{name}}!</h1>
	<p>{{content}}</p>
	
	// then to echo it
	$values = array(
		'name' => 'World',
		'content' => 'Lorem ipsum'
	);
	echo $this->template->render('foo.html', $values);
	
	/*
	<h1>Hello World!</h1>
	<p>Lorem ipsum</p>
	*/