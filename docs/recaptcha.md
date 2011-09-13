# ReCAPTCHA

[ReCAPTCHA](http://www.google.com/recaptcha) is a free CAPTCHA service.

## loading ReCAPTHCA

Before using ReCAPTCHA, you need to get an [api key](http://www.google.com/recaptcha/whyrecaptcha). Enter your public and private key in *content/_config/api-keys.php*.

One more step before using the ReCAPTHCA helper, you need to use the [load](load) it.

	$this->load('recaptcha');

## Displaying a CAPTCHA field

Displaying a CAPTCHA field is easy. Within your &lt;form> tags:

	echo recaptcha_get_html();

## Validating CAPTCHA

There is one more set in using ReCAPTHCA and that's validating the user's input. Remember to load the ReCAPTCHA helper in your form submit script.

### Syntax

	recaptcha_check_answer(remoteip, challenge, response)

### Parameters

* remoteip - (*string*) the user's ip address (default $_SERVER['REMOTE_ADDR'])
* challenge - (*string*) recaptcha challenge field (default $_REQUEST['recaptcha_challenge_field'])
* response - (*string*) user's captcha response (default $_REQUEST['recaptcha_response_field'])

### Returns

* (*object*) object containing ReCAPTCHA information

### Example

	$resp = recaptcha_check_answer();
	
	if(!$resp->is_valid){
		// not a valid recaptcha, die or reload the page
		// error code available with $resp->error
	}else{
		// recaptcha was successful, continue to process the form
	}