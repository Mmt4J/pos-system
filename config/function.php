<?php

session_start();

require 'dbcon.php';

// Input field validation
function validate($inputData) {

	global $conn;

	$validatedData = mysqli_real_escape_string($conn, $inputData);
	return trim($validatedData);
}

// Redirect with message (status)
function redirect($url, $message) {

		$_SESSION['status'] = $status;
		header('location: ' . $url);
		exit(0);
}

// Display message after any process
function alertMessage(){

	if (isset($_SESSION['status'])) {
		echo 
			'<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  			<h6>'.$_SESSION['status'].'</h6>
		  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>'
		unset($_SESSION['status']);
	}
}

// Insert Records
function insert($tableName, $data) {
	global $conn;

	$table =validate($tableName);

	$columns = array_keys($data);
	$values	= array_values($data);


	$finalColumn = impolde(',', $columns);
	$finalValue = "'".impolde("', '", $values)."'";

	$query = "INSERT INTO $table ($finalColumn) VALUES ($finalValue)";

	$result = mysqli_query($conn, $query);

}