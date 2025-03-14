<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

    include("../connect/connect.php");

	
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	$strCustomerID = "C005";

	$sql = "DELETE FROM customer
			WHERE CustomerID = ? ";
	$params = array($strCustomerID);

	$stmt = $conn->prepare($sql);
	$stmt->execute($params);

	if( $stmt->rowCount() ) {
		echo "Record delete successfully";
	}

	$conn = null;
?>