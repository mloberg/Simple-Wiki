# Image Manipulation

Image manipulation class using the GD PHP library.

### output options

* path - The path to where you want to file to be saved
* name - The name of the new image. Does not require extension
* type - The filetype to save as. Not required
* quality - Only for jpg images. Not requried

## save_as

Save an image as a specific file type

### Syntax

	$this->image->save_as(file, output);

### Parameters:

* **file** - (*string*) the location of the file (inside the public dir)
* **output** - (*array*) output options (see above)

### Returns

* (*boolean*) true if image was saved, false if it was not

### Example:

	$output = array(
		'path' => 'uploads',
		'name' => 'image',
		'type' => 'png'
	);
	if($this->image->save_as('uploads/image.jpg', $output)){
		// uploads/image.png saved
	}else{
		// image was not saved
	}

## rotate

Rotate an image

### Syntax

	$this->image->rotate(file, rotate, output);

Parameters:

* **file** - (*string*) the location of the file (inside the public dir)
* **rotate** - (*string* or *integer*) rotate amount (left, right, flip, or degrees)
* **output** - (*array*) output options (see above)

### Returns

* (*boolean*) true if file was saved, false if not

### Example:

	$output = array(
		'path' => 'uploads/thumb',
		'name' => 'image_thumb',
		'type' => 'png'
	);
	if($this->image->rotate('uploads/image.jpg', 'right', $output)){
		// file rotated and saved
	}else{
		// file not saved
	}

## crop

Crop an image

### Syntax

	$this->image->crop(file, options, output);

Parameters:

* **file** - (*string*) the location of the file (inside the public dir)
* **options** - (*array*) width, length, x and y
* **output** - (*array*) output options (see above)

### Returns

* (*boolean*) true if image was created, false if it was not

### Example:

	$file = 'uploads/image.jpg';
	$options = array(
		'width' => 300,
		'height' => 200,
		'x' => 100,
		'y' => 100
	);
	$output = array(
		'path' => 'uploads/thumb',
		'name' => 'image_thumb',
		'type' => 'png'
	);
	if($this->image->crop($file, $options, $output)){
		// file was cropped
	}else{
		// something went wrong
	}

## resize

Resize an image.

### Syntax

	$this->image->resize(file, options, output);

### Parameters:

* **file** - (*string*) the location of the file (inside the public dir)
* **options** - (*array*) width and length
* **output** - (*array*) output options (see above)

### Returns

* (*boolean*) true if image was saved, false if was not

### Example:

	$file = 'uploads/image.jpg';
	$options = array(
		'width' => 300,
		'height' => 200
	);
	$output = array(
		'path' => 'uploads/thumb',
		'name' => 'image_thumb',
		'type' => 'png'
	);
	if($this->image->resize($file, $options, $output)){
		// file was resized
	}else{
		// something went wrong
	}

## scale

Scale an image

### Syntax

	$this->image->scale(file, options, output);

Parameters:

* **file** - (*string*) the location of the file (inside the public dir)
* **options** - (*array*) percent, width, or height to scale by
* **output** - (*array*) output options (see above)

### Returns

* (*boolean*) true if image was saved, false if it was not

### Example:

	$file = 'uploads/image.jpg';
	$options = array(
		'percent' => '80'
	);
	$output = array(
		'path' => 'uploads/thumb',
		'name' => 'image_thumb',
		'type' => 'png'
	);
	if($this->image->scale($file, $options, $output)){
		// file was created
	}
	
	// or scale to a specific width or height
	$options2 = array(
		'width' => 900
	);
	$this->image->scale($file, $options2, $output);

### watermark

Add a watermark to an image.

### Syntax

	$this->image->watermark(file, watermark, output, options)

### Parameters

* **file** - (*string*) the location of the file (inside of the public dir)
* **watermark** - (*string*) location of the watermark image 
* **output** - (*array*) output options (see above)
* options - (*array*) x, y of watermark position (top, bottom, left, right, center, or pixels)

### Returns

* (*boolean*) true if image was saved

### Example

	$output = array(
		'path' => 'uploads/thumb',
		'name' => 'image_watermark',
		'type' => 'png'
	);
	if($this->image->watermark('image.png', 'watermark.png', $output)){
		// overlays the watermark image in the top left corner
	}
	if($this->image->watermark('image.png', 'watermark.png', $output, array('x' => 'center', 'y' => 'center'))){
		// overlays the watermark image in the center of the image
	}