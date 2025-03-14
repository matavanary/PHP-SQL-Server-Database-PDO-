<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

    include("../connect/connect.php");

	
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
    
	$stmt = $conn->prepare(" CALL my_stored_procedure(?) ");
	$stmt->execute();

	$conn = null;
?>