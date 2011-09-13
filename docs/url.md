## url

Return the part or all of the url.

### Syntax

	$this->url(segement);

### Parameters:

* segement - (*integer*) if empty, returns full request string, other wise the part of the string (split by /)

### Returns

* (*string*) the requested part of the url

### Example:

	// page is http://example.com/user/1/posts
	$request = $this->url(); // would return user/1/posts
	$id = $this->url(2); // would return 1
	echo $this->url(3); // would return posts