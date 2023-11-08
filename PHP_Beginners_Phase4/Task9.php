<?php

// Display all errors, warnings, and notices
error_reporting(E_ALL);

// Custom error handling function
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "Custom Error Handler:\n";

    switch ($errno) {
        case E_ERROR:
        case E_USER_ERROR:
            echo "Fatal Error: $errstr in $errfile on line $errline\n";
            exit(1);
            break;

        case E_WARNING:
        case E_USER_WARNING:
            echo "Warning: $errstr in $errfile on line $errline\n";
            break;

        case E_PARSE:
            echo "Parse Error: $errstr in $errfile on line $errline\n";
            break;

        case E_NOTICE:
        case E_USER_NOTICE:
            echo "Notice: $errstr in $errfile on line $errline\n";
            break;

        default:
            echo "Unknown error type: $errno\n";
            break;
    }
}

// Set the custom error handler
set_error_handler("customErrorHandler");

// Trigger different types of errors
echo "Triggering errors:\n";

// Parse error (e.g., missing semicolon)
echo $parseError;

// Fatal error (e.g., calling an undefined function)
undefinedFunction();

// Warning (e.g., using an undefined variable)
$undefinedVariable;

// Notice (e.g., using an undefined array key)
$exampleArray = array("key" => "value");
echo $exampleArray["nonexistent_key"];

// Restore the default error handler
restore_error_handler();

// This will not be caught by the custom error handler
echo "This will not be caught by the custom error handler.";

?>
