<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

    include("../connect/connect.php");

	
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	$strName = "Weerachai Nukitram";
	$strEmail = "webmaster@thaicreate.com";
	$strCountryCode = "TH";
	$strBudget = "6000000";
	$strUsed = "100000";

	$strCustomerID = "C005";

	$sql = "UPDATE customer SET 
				Name = ? ,
				Email = ? ,
				CountryCode = ? ,
				Budget = ? ,
				Used = ?
				WHERE CustomerID = ? ";
	$params = array($strName, $strEmail, $strCountryCode, $strBudget, $strUsed,$strCustomerID);

	$stmt = $conn->prepare($sql);
	$stmt->execute($params);

	if( $stmt->rowCount() ) {
		 echo "Record update successfully";
	}

	$conn = null;

?>