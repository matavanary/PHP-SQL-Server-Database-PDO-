<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

    include("../connect/connect.php");

	
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	$strCustomerID = "C005";
	$strName = "Weerachai Nukitram";
	$strEmail = "webmaster@thaicreate.com";
	$strCountryCode = "TH";
	$strBudget = "6000000";
	$strUsed = "0";

	$sql = "INSERT INTO customer (CustomerID, Name, Email, CountryCode, Budget, Used) VALUES (?, ?, ?, ?, ?, ?)";
	$params = array($strCustomerID, $strName, $strEmail, $strCountryCode, $strBudget, $strUsed);

	$stmt = $conn->prepare($sql);
	$stmt->execute($params);

	if( $stmt->rowCount() ) {
		echo "Record add successfully";
	}

	$conn = null;

?>