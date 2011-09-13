# Postmark

[Postmark](http://postmarkapp.com) is a email delivery service that is awesome. This is a simple class that allows you to send emails using Postmark.

Before using this class, make sure your API information is set in *content/_config/api-keys.php*.

## To

Specify the email recipient.

### Syntax

	$this->postmark->to(email);

### Parameters:

* **email** - (*string*) recipient's email address

### Returns

* (*null*)

### Example:

	$this->postmark->to('mail@example.com');

## Subject

Specify the email's subject line

### Syntax

	$this->postmark->subject(subject);

### Parameters:

* **subject** - (*string*) email's subject line

### Returns

* (*null*)

### Example:

	$this->postmark->subject('Test Email');

## Message

Send a plain text or HTML message

### Syntax

	$this->postmark->message(message, type);

### Parameters:

* **message** - (*string*) email message, if html, only the html within the &gt;body> tags is required
* type - (*string*) html or text (default text)

### Returns

* (*null*)

### Example:

	// plain message
	$this->postmark->message('Plain old message.');
	// html message
	$this->postmark->message('<h1>Hello World!</h1><p>Foobar</p>', 'html');

## Tag

Tag an email for use in Postmark statistics.

### Syntax

	$this->postmark->tag(tag);

### Parameters:

* **tag** - (*string*) tag name

### Returns

* (*null*)

### Example:

	$this->postmark->tag('test email');

## send

Send an email using postmark.

### Syntax

	$this->postmark->send(data);

### Parameters:

* data - (*array*) Postmark info, will overwrite any info set with above methods

### Returns

* (*boolean*) true if message was sent

### Example:

	// make sure you have set to, subject, and message
	if($this->postmark->send()){
		// email was sent
	}else{
		// email was not send, use $this->postmark->e() to find out what the issue is
	}

## error

If Postmark was not able to send, find out what went wrong.

### Syntax

	$this->postmark->e();

### Parameters:

* none

### Returns

* (*array*) array of error information

### Example:

	if(!$this->postmark->send()){
		print_r($this->postmark->e());
	}

### Notes:

See [Postmark Docs](http://developer.postmarkapp.com/developer-build.html#api-error-codes) for list of error codes.

# Example

This class is designed to chain methods rather then calling them one at a time.

	if($this->postamark->to('mail@example.com')->subject('Test Email')->message('Plain message email.')->send()){
		// email was sent
	}else{
		print_r($this->postmark->e());
	}