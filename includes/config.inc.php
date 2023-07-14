<?php

/* - Constant definitions and settings
 * - Error handling
 * - Useful functions
 */

// ************************************ //
// ************ SETTINGS ************** //

// Variable for page status
define('LIVE', FALSE);

// Administrator email
define('EMAIL', 'XXXXXXXX@YYYY.COM');

/* 	The next two variables make the page more flexible
	when transferring to another location, only these two
	constants need to be changed   */


// In reality - website URL (for redirects)
define('BASE_URL', 'add link');


// Location of the database configuration file
define('MYSQL', 'location of database');

// Set the time zone (PHP 5.1 or higher)
date_default_timezone_set('Europe/Ljubljana');


// ****************************************** //
// ************ ERROR HANDLING ************ //

// Create an error handler
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
{

	// Create an error message
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";

	// Add date and time
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";

	if (!LIVE) { // Display errors during development

		// Display errors during development
		echo '<div class="error">' . nl2br($message);

		// Add error details
		echo '<pre>' . print_r($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';

	} else { // Prevent error display when site is live

		// Send an email message to the administrator
		$body = $message . "\n" . print_r($e_vars, 1);


		// General error display
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	}
}

// // Use the defined error handler function
// set_error_handler('my_error_handler');
