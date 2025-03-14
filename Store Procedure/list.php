<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

    include("../connect/connect.php");

	$strCustomerID = "C001";

	
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	$sql = "SELECT * FROM customer WHERE CustomerID = ? ";
	$params = array($strCustomerID);

	$stmt = $conn->prepare($sql);
	$stmt->execute($params);

	while($result = $stmt->fetch( PDO::FETCH_ASSOC ))
	{
		//$result["CustomerID"];
	}

?>