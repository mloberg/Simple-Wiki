# Helpful

Helpful is a TFD helper or a bunch of functions.

## stylesheet link tag

Load stylesheets found in public/css.

**DEPRECATED** This function has been deprecated as of v1.3. Please use the (CSS)[css] instead.

### Syntax

	stylesheet_link_tag(scripts, extension);

### Parameters:

* **scripts** - (*string* or *array*) stylesheets with the extension dropped off (string - single stylesheet, array - multiple stylesheets)
* extension - (*string*) extension of the stylesheet (default 'css')

### Returns

* (*string*) &lt;link> tag(s)

### Example:

	echo stylesheet_link_tag('style');
	$stylesheets = array('reset', 'style');
	echo stylesheet_link_tag($stylesheets);

## redirect

Header('Location') wrapper.

### Syntax

	redirect(url, message, type, options);

### Parameters:

* **url** - (*string*) url you want to redirect to
* message - (*string*) [flash](flash) message (if you are redirecting to another page)
* type - (*string*) [flash](flash) type (default 'message')
* options - (*array*) array of [flash](flash) options

### Returns

* (*null*)

### Example:

	// redirect to external site
	redirect('http://example.com');
	// redirect to blog/post/2 on the site
	redirect('blog/post/2')

## image tag

Returns a valid &lt;img> tag (with alt, width, and height) from an image found in *public/*

### Syntax

	image_tag(source, alt);

### Parameters:

* **source** - (*string*) name of image
* **alt** - (*string*) alt text of image

### Returns

* (*string*) valid &lt;img> tag

### Example:

	echo image_tag('images/image.jpg', 'Image');

## post

$_POST wrapper

### Syntax

	post(name);

### Parameters:

* **name** - (*string*) post variable to get

### Returns

* (*string*) the post variable

### Example:

	echo post('name');

## get

$_GET wrapper

### Syntax

	get(name);

### Parameters:

* **name** - (*string*) get variable to get

### Returns

* (*string*) the get variable

### Example:

	echo get('id');

## print pretty

print_p wrapped in &lt;pre> tags

### Syntax

	print_p(var);

### Parameters:

* **var** - (*mixed*) any variable (array, string, integer)

### Returns

* (*string*) &lt;pre> variable &lt;pre>

### Example:

	print_p($_SESSION);

## link tag

&lt;a> tag wrapper

### Syntax

	href(link, text, admin);

### Parameters:

* **link** - (*string*) url to link to (can be external (start with http) or internal)
* **text** - (*string*) the text to link
* admin - (*boolean*) will prepend the admin path to your link (must be internal link) (default false)

### Returns

* (*string*) &lt;a> tag

### Example:

	// external link
	echo href('http://example.com', 'External Link');
	// link to yoursite.com/user/admin
	echo href('user/admin', 'Internal Link');
	// link to an admin part of your site
	echo href('user/edit/1', 'Edit user', true);

## math eval

Take a math equation as a string and evaluate it.

### Syntax

	matheval(equation);

### Parameters:

* equation - (*string*) Math equation as a string

### Returns

* (*integer*) value of equation

### Example:

	$equation = '50/100';
	echo matheval($equation); // 0.5

## user agent parser

Get the important information (platform, browser, version) from a user agent string

### Syntax

	parse_user_agent(user-agent);

### Parameters:

* user-agent - (*string*) user agent (defaults to $_SERVER['HTTP_USER_AGENT'])

### Returns

* (*array*) platform, browser, browser version

### Example

	print_r(parse_user_agent());