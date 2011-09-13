# Elements

TFD includes an elements class to help you render out html elements.

To use this class, you first must [load](load) the class.

	$this->load('elements');

## Text

Render out text tags.

### Syntax

	html::type(text, extra);

### Parameters

* **type** - (*string*) the text tag (p,h1-h6)
* **text** - (*string*)
* extra - (*string*)

### Returns

* (*string*) html tag

### Example

	echo html::h1('Hello World!');
	echo html::p('Lorem Ipsum', '');

## br

Render out an html break.

### Syntax

	html::br();

### Parameters

* none

### Returns

* (*string*) html tag

### Example:

	echo html::br();

## List

Render out an html list.

### Syntax

	html::type(items, extra);

### Parameters

* **type** - (*string*) unordered (ul) or ordered list (ol)
* **items** - (*array*) list of items
* extra - (*string*)

### Returns

* (*string*) html

### Example:

	$li = array('Item 1', 'Item 2', 'Item 3');
	echo html::ul($li, 'id="list"');

# Form Elements

## Form Open

Open a form tag.

### Syntax

	form::open(action, method, extra);

### Parameters

* **action** - (*string*) where to post the form
* method - (*string*) form method (default post)
* extra - (*string*)

### Returns

* (*string*) html

### Example:

	// post request to form_submit
	echo form::open('form_submit');
	// get request to the same page
	echo form::open('', 'get');

## Upload Open

Open a form tag for a file upload.

### Syntax

	form::open_upload(action, extra);

### Parameters

* **action** - (*string*) where to post the form
* extra - (*string*)

### Returns

* (*string*) html

### Example

	echo form::open_upload('upload');

## Form Close

Close a form.

### Syntax

	form::close()

### Parameters

* none

### Returns

* (*string*) &lt;/form>

### Example

	echo form::close();

## Label

Form label.

### Syntax

	form::label(for, text);

### Parameters

* **for** - (*string*) the input the label is for
* **text** - (*string*) label text

### Returns

* (*string*) html

### Example:

	echo form::label('name', 'Name');

## Input

Creating a &lt;input type="text" /> tag

### Syntax

	form::input(name, value, options)

### Parameters

* **name** - (*string*) the name of the form element
* value - (*string*) the default value of the input
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of input

### Example

	echo form::input('fname');

## Password

Creating a &lt;input type="password" /> tag

### Syntax

	form::password(name, value, options)

### Parameters

* **name** - (*string*) the name of the form element
* value - (*string*) the default value of the input
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of input

### Example

	echo form::password('password');

## File Upload

Creating a &lt;input type="file" /> tag

### Syntax

	form::file_upload(name, options)

### Parameters

* **name** - (*string*) the name of the form element
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of input

### Example

	echo form::file_upload('image');

## Submit

Creating a &lt;input type="submit" /> tag

### Syntax

	form::submit(value, options)

### Parameters

* **value** - (*string*) the default value of the input
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of input

### Example

	echo form::submit('Upload Image');

## Textarea

Creating a &lt;textarea> tag

### Syntax

	form::textarea(name, value, options)

### Parameters

* **name** - (*string*) the name of the form element
* value - (*string*) the default value of the input
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of textarea

### Example

	echo form::textarea('about');

## Dropdown

Creating a &lt;select> tag

### Syntax

	form::dropdown(name, values, selected, options)

### Parameters

* **name** - (*string*) the name of the form element
* **values** - (*array*) array of options (value is key, name is value)
* selected - (*string*) select an option by default
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of select

### Example

	echo form::dropdown('year', array('2011' => '2011', '2010' => '2010'), '2011');

## Radio Button

Creating a &lt;input type="radio" /> tag

### Syntax

	form::radio(name, values, options)

### Parameters

* **name** - (*string*) the name of the form element
* **values** - (*array*) array of options (value is key, name is value)
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of input

### Example

	echo form::radio('gender', array('m' => 'Male', 'f' => 'Female'));

## Multi Checkbox

Creating a multi &lt;input type="radio" /> tag.

### Syntax

	form::checkbox(name, values, options)

### Parameters

* **name** - (*string*) the name of the form element
* **values** - (*array*) array of options (value is key, name is value)
* options - (*mixed*) array or string of extra options (class, id, disabled, checked, etc)

### Returns

* (*string*) html of input

### Example

	echo form::checkbox('grade', array('9' => 'freshman', '10' => 'sophomore', '11' => 'junior', '12' => 'senior'));
