# Amazon S3

This library is based off of Donovan Schonknecht's [Amazon S3 PHP Class](http://undesigned.org.za/2007/10/22/amazon-s3-php-class).

Make sure you set your Access and Secret keys in *content/_config/api-key.php*.

## set authentication information

Manually set your access and secret keys.

### Syntax

	$this->s3->set_auth(access, secret);

### Parameters

* **access** - (*string*) your access key
* **secret** - (*string*) your secret key

### Returns

* (*null*)

### Example:

	$this->s3->set_auth(accesskey, secretkey);

## set access level

Set the access level of uploads

### Syntax

	$this->s3->set_acl(level);

### Parameters

* **level** - (*string*) the access level (private, public-read, public-read-write, authenticated-read)

### Returns

* (*null*)

### Example:

	$this->s3->set_acl('private');

## get access level

Get the current access level

### Syntax

	$this->s3->get_acl();

### Parameters

* none

### Returns

* (*string*) access level

### Example:

	if($this->s3->get_acl() !== 'private'){
		$this->s3->set_acl('private');
	}

## set bucket

Set the bucket to upload to.

### Syntax

	$this->s3->set_bucket(bucket)

### Parameters

* **bucket** - (*string*) bucket to upload to

### Returns

* (*null*)

### Example:

	$this->s3->set_bucket('your_bucket');

## get bucket

Get the current bucket.

### Syntax

	$this->s3->get_bucket();

### Parameters

* none

### Returns

* (*string*) the current bucket

### Example:

	if($this->s3->get_bucket() != 'your_uploads'){
		$this->s3->set_bucket('your_uploads');
	}

# Bucket Methods

Methods to work with buckets.

## list buckets

List all your buckets.

### Syntax

	$this->s3->listBuckets(detailed);

### Parameters

* detailed - (*boolean*) return more details about the bucket

### Returns

* (*array*) bucket list

### Example:

	print_r($this->s3->listBuckets());
	// detailed information
	print_r($this->s3->listBuckets(true));

## Bucket Items

List bucket contents.

### Syntax

	$this->s3->list_items(prefix, marker, maxKeys, delimiter, returnCommonPrefixes);

### Parameters

* prefix - (*string*)
* marker - (*string*)
* maxKeys - (*integer*)
* returnCommonPrefixes - (*boolean*)

### Returns

* (*array*) array of items and their information

### Example:

	print_r($this->s3->list_items());

## Create Bucket

Create a bucket.

### Syntax

	$this->s3->create_bucket(bucket);

### Parameters

* bucket - (*string*) name of the bucket (if empty, uses bucket set by set_bucket() or default bucket)

### Returns

* (*boolean*) true if bucket was created

### Example:

	if($this->s3->create_bucket('new_bucket')){
		// do stuff with the new bucket
	}

## Delete Bucket

Delete an empty bucket.

### Syntax

	$this->s3->delete_bucket(bucket);

### Parameters

* bucket - (*string*) bucket to delete (if empty, uses bucket set by set_bucket() or default bucket)

### Returns

* (*boolean*) true if bucket was deleted

### Example:

	if($this->s3->delete_bucket('new_bucket')){
		// bucket was deleted
	}

## Get Bucket Location

Get the bucket location. (US or EU)

### Syntax

	$this->s3->get_bucket_location(bucket);

### Parameters

* bucket - (*string*) name of the bucket (if empty, uses bucket set by set_bucket() or default bucket)

### Returns

* (*mixed*) false if bucket does not exists, otherwise a string

### Example:

	if(($location = $this->s3->get_bucket_location('new_bucket')) !== false){
		echo 'Bucket location: '.$location;
	}

# Object Methods

Methods to work with objects.

## Put Object

Upload an object.

### Syntax

	$this->s3->put_object(file, uri, metaHeaders, requestHeaders);

### Parameters

* **file** - (*string*) location of the file to upload
* **uri** - (*string*) name of the file on s3
* metaHeaders - (*array*)
* requestHeaders - (*array*) custom request Headers

### Returns

* (*boolean*) true if object was uploaded

### Example:

	// set the bucket to upload to
	$this->s3->set_bucket('new_bucket');
	if($this->s3->put_object(PUBLIC_DIR.'uploads/image.jpg', 'new-image.jpg')){
		// file uploaded
	}
	// custom headers
	$this->s3->put_object(
		PUBLIC_DIR.'uploads/test.jpg',
		'img/test-img.jpg',
		array(),
		array(
			'Expires' => gmdate('D, d M Y H:i:s T', strtotime('+5 years'))
		)
	);

## Get Object

Save an object.

### Syntax

	$this->s3->get_object(uri, saveTo);

### Parameters

* **uri** - (*string*) object on S3
* saveTo - (*mixed*) resource to save to, or path to save to

### Returns

* (*mixed*) false if file does not exist or an object

### Example:

	$this->s3->set_bucket('new_bucket');
	
	if(($object = $this->s3->get_object('img/test.jpg', PUBLIC_DIR.'test.jpg'))){
		print_r($object);
	}else{
		echo 'something went wrong';
	}

## Get Object Info

Get object information.

### Syntax

	$this->s3->get_object_info(uri, info);

### Parameters

* **uri** - (*string*) object on S3
* info - (*boolean*) get detailed info (default true)

### Returns

* (*mixed*) false if file does not exist or an array of information

### Example:

	$this->s3->set_bucket('new_bucket');
	
	if(($info = $this->s3->get_object_info('img/test.jpg', false))){
		print_r($info);
	}else{
		echo 'object does not exist';
	}

## Copy Object

Copy an object from another bucket.

### Syntax

	$this->s3->copy_object(sourceBucket, sourceURI, uri, metaHeaders, requestHeaders);

### Parameters

* **sourceBucket** - (*string*) bucket to copy from
* **sourceURI** - (*string*) object to copy
* **uri** - (*string*) name of the file on s3
* metaHeaders - (*array*)
* requestHeaders - (*array*) custom request headers

### Returns

* (*boolean*) true if object was copied

### Example:

	$this->s3->set_bucket('new_bucket');
	
	if($this->s3->copy_object('source_bucket', 'example.jpg', 'example.jpg')){
		echo 'file copied';
	}else{
		echo 'something went wrong';
	}

## Delete Object

Delete an object.

### Syntax

	$this->s3->delete_object(object);

### Parameters

* **object** - (*string*) object to delete

### Returns

* (*boolean*) true if file was deleted

### Example:

	$this->s3->set_bucket('new_bucket');
	
	if($this->s3->delete_object('img/test.jpg')){
		echo 'file deleted';
	}else{
		echo 'something went wrong';
	}

## Get Authenticated URL

Create an authenticated URL to a private object.

### Syntax

	$this->s3->get_authenticated_url(uri, lifetime, hostBucket, https)

### Parameters

* **uri** - (*string*)
* **lifetime** - (*integer*)
* hostBucket - (*boolean*)
* https - (*boolean*) use https

### Returns

* (*string*) authenticated url

### Example:

	$this->s3->set_bucket('new_bucket');
	
	echo $this->s3->get_authenticated_url('protected.jpg', 3600);