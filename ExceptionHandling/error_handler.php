<?php
// Create a mysqli object
$mysqli = new mysqli('localhost', 'root', '', 'studentinfo') or die('Database connection failed: ' . $mysqli->connect_error);


// Define a custom exception handler
function exceptionHandler($exception)
{
    global $mysqli;

    // Get exception details
    $message = $exception->getMessage();
    $code = $exception->getCode();
    $file = $exception->getFile();
    $line = $exception->getLine();
    $trace = $exception->getTraceAsString();

    // Prepare and execute SQL statement to save exception details
    $stmt = $mysqli->prepare("INSERT INTO exceptions (message, code, file, line, trace) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $message, $code, $file, $line, $trace);
    $stmt->execute();

    // Output an error message to the user or log it
    // echo 'An error occurred. Please try again later.';

    // You can also log the error to a file or send an email notification
}

// Set the custom exception handler
set_exception_handler('exceptionHandler');

?>