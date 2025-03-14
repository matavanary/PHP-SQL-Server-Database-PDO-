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

	$sql = "DELETE FROM customer
			WHERE CustomerID = ? ";
	$params = array($_GET["CustomerID"]);

	$stmt = $conn->prepare($sql);
	$stmt->execute($params);

	if( $stmt->rowCount() ) {
	 echo "Record delete successfully";
	}

	$conn = null;
?>
</body>
</html>