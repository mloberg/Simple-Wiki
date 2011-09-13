# Upload

The upload class makes file uploading a cinch.

## is_type

Check to see if the upload is a specific file type

### Syntax

	$this->upload->is_type(file_name, extension)

### Parameters

* **file_name** - (*string*) The name of the file input field
* **extension** - (*mixed*) array or string of valid file extensions

### Returns

* (*boolean*) true if it matches, false if it doesn't

### Example

	if($this->upload->is_type('image', 'jpg')){
	  // file ends in jpg
	}
	$this->upload->is_type('image', 'jpg|jpeg'); // matches both jpg and jpeg
	$file_types = array('jpg', 'jpeg', 'png', 'gif', 'mov', 'flv');
	$this->upload->is_type('image', $file_types);

## is_image

Check to see if the file is an image (gif, jpg, png, or tiff)

### Syntax

	$this->upload->is_image(file_name)

### Parameters

* **file_name** - (*string*) The name of the file input field

### Returns

* (*boolean*) true if the file is an image

### Example

	if($this->upload->is_image('image')){
	  // file is an image
	}

## exists

Check to see if the file already exists

### Syntax

	$this->upload->exists(file_name, path);

### Parameters

* **file_name** - (*string*) The name of the file input field
* **path** - (*string*) the directory inside the public dir you want to check

### Returns

* (*boolean*) true if file exists, false if it doesn't

### Example

	if(!$this->upload->exists('image', 'uploads')){
	  // file does not already exist, go ahead and upload
	}

## size

Get the file size

### Syntax

	$this->upload->size(file_name, unit)

### Parameters

* **file_name** - (*string*) The name of the file input field
* unit - (*string*) the file size unit to return in (kb, mb, gb)

### Returns

* (*string*) file size

### Example

	$this->upload->size('image'); // returns bytes
	$this->upload->size('image', 'mb'); // returns megabytes

## Save

Saves an upload

### Syntax

	$this->upload->save(file_name, path, name, extension)

### Parameters

* **file_name** - (*string*) The name of the file input field
* **path** - (*string*) the path to upload the file to (inside of the public dir)
* name - (*string*) the name you wish to save the file as (defaults to the upload name)
* extension - (*string*) by default, the upload class will append the current extension to the file. Use this if you wish to force and extension

### Returns

* (*boolean*) true if the file was saved successfully, false if it was not saved

### Example

	if($this->upload->save('image', 'uploads')){
	  // file was saved successfully
	}else{
	  // file did not save
	  // most likely the uploads folder does not exist in the public dir, or apache does not have permission to write to the directory.
	}
	
	// if you wish to save it with a specific name
	$this->upload->save('image', 'uploads', 'new-file', 'jpg'); // if you want to save as new-file.jpg
	// or add the extension automatically
	$this->upload->save('image', 'uploads', 'new-file');