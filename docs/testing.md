# Testing

TFD allows for different [environments](environments). One feature of environments is the ability for testing.

Setting an environment as a testing environment adds a couple of features to the environment.

## Setting Up Testing

Inside of *content/_config/environments.php* there is an option called *TESTING_MODE* turn this to *true* to turn testing mode on.

## Testing Mode Features

### Enhanced Error Reporting

If testing mode is turned on, TFD shares more information if it encounters any errors. If it can't find a file, it tells you what file rather then 404ing.

If you are using the [Error Class](error), it will also display the error to the screen, as well as logging or email the error.

### Tries To Finish Out The Script

If TFD encounters an error, the default action is to exit the script. If testing mode is turned on, it will try to complete the script.

## Other Uses

*$this->testing* tells you if testing mode is turned on or off. If you want to hide a div, or not display a page, unless your in testing mode, you can use an if statement.

### Example

	// show a div
	<?php if($this->testing);?>
	<div>
		<p>This should only be displayed if testing mode is turned on.</p>
	</div>
	<?php endif;>
	
	// or hide a page
	<?php
		if(!$this->testing){
			$this->send_404();
			$master = '404';
		}