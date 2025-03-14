<html>
<head>
<title>ThaiCreate.Com PHP & SQL Server (PDO)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

    include("../connect/connect.php");
  
   
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	$sql = "INSERT INTO customer (CustomerID, Name, Email, CountryCode, Budget, Used) 
		VALUES (?, ?, ?, ?, ?, ?)";
   $params = array($_POST["txtCustomerID"], $_POST["txtName"], $_POST["txtEmail"], $_POST["txtCountryCode"], $_POST["txtBudget"], $_POST["txtUsed"]);

	$stmt = $conn->prepare($sql);
	$stmt->execute($params);
	
	if( $stmt->rowCount() ) {
		 echo "Record add successfully";
	}

	$conn = null;
?>
</body>
</html>