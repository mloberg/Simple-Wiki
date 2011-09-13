# CSS

Along with doing CSS normally (e.g. &lt;link rel="stylehseet" href="css/style.css" />), TFD includes a helper function as well as a class to help with CSS.

# Helper Function

Load a stylesheet found in public/css.

**DEPRECATED** as of v1.3. Please use the CSS class instead.

### Syntax

	stylesheet_link_tag(script name, extension);

### Parameters:

* **script name** - (*string*) the name of the stylesheet with the extension dropped off
* extension - (*string*) the extension of the stylesheet (default 'css')

### Returns

* (*string*) html of &lt;link> tag

### Example:

	echo stylesheet_link_tag('style');
	// or a .php file written as a css file
	echo stylesheet_link_tag('style', 'php');

# CSS Library

This library does a couple of things. First off it allows you to load stylesheets from your page. This can be a local stylesheet or an external stylesheet (http://)

Secondly it allows you to add raw css to your page by use of &lt;style> tags. This feature is experimental and still in active development.

## echo_stylesheets

Print out all the files loaded by the CSS class.

### Syntax

	$this->css->echo_stylesheets();

### Parameters:

* none

### Returns

* (*string*) echos out all the &lt;link> tags for all stylesheets loaded

### Example:

	// no need to echo, it does it for you
	$this->css->echo_stylesheets();

### Notes:

In the default master file, you will find this function in the &lt;head>.

## load

Add a stylesheet to the class to be printed out.

### Syntax

	$this->css->load(source, order);

### Parameters:

* **source** - (*string*) the location of the css file or a pre-loaded script
* order - (*integer*) order of the stylesheet in load array

### Returns

* (*null*)

### Example:

	$this->css->load('css/style.css');
	// or a pre-loaded script
	$this->css->load('reset', 0);

### Pre-Loaded Stylesheets:

* [reset](http://developer.yahoo.com/yui/reset/)
* [ui-lightness](http://jqueryui.com/) (called as *jquery-ui*)

## add_sheet

Add a stylesheet to the pre-loaded stylehseet array.

### Syntax

	$this->css->add_sheet(name, source, load, order);

### Parameters:

* **name** - (*string*) the name of the stylesheet (used for load() method)
* **source** - (*string*) the location of the stylesheet
* load - (*boolean*) load the stylesheet (default *false*)
* order - (*integer*) load order

### Returns

* (*null*)

### Example:

	$this->css->add_sheet('blitzer', 'css/blitzer/jquery-ui-1.8.12.custom.css');
	// and then to call it
	$this->css->load('blizter');
	// or in one shot
	$this->css->add_sheet('blitzer', 'css/blizter/jquery-ui-1.8.12.custom.css', true);

### Notes

Why would you use this? With use of [Hooks](hooks), this can shorten your code.

# Styling

These are all the functions that add raw CSS to your page by &lt;style> tags.

## add_font

Add @font-face line to the beginning of the style tags.

### Syntax

	$this->css->add_font(name, source);

### Parameters:

* **name** - (*string*) name of the font
* **source** - (*string*) location of the font

### Returns

* (*null*)

### Example:

	$this->css->add_font('name', 'path/to/font.ttf');

## style

The main function for adding raw css.

### Syntax

	$this->css->style(styles);

### Parameters:

* **styles** - (*array*) Array of styles.

### Returns

* (*null*)

### Example:

	$styles = array(
		'element' => array(
			'background-color' => '#f8f8ff'
		),
		'#id' => array(
			'color' => '#999'
		),
		'.class' => array(
			// styles
		)
	);
	$this->css->style($styles);
	
	// will render something like
	<style>
	element{
		background-color: #f8f8ff;
	}
	#id{
		color: #999;
	}
	.class{
		
	}
	</style>

### Notes

This method has support for a couple of CSS3 methods. See below.


# CSS3 Methods

## border-radius

border-radius

### Syntax

	'border-radius' => radius

### Parameters:

* **radius** - (*string*) the roundness of edges

### Example:

	$style = array(
		'element' => array(
			'border-radius' => '5px'`
		)
	);

## box-shadow

box-shadow

### Syntax

	'drop-shadow' => array(
		'spread' => spread,
		'blur' => blur,
		'color' => color
	)

### Parameters:

All these parameters are optional and don't even need to be sent.

* spread - (*string*) the amount the shadow spreads down and left (default 2px)
* blur - (*string*) the blur amount of the shadow (default 5px)
* color - (*string*) the color of the shadow (default #000)

### Example:

	$style = array(
		'element' => array(
			'drop-shadow' => array(
				'spread' => '2px',
				'blur' => '5px',
				'color' => '#000'
			)
		)
	);