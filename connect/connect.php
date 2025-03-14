<html>
<head>
<title>ThaiCreate.Com PHP & SQL Server (PDO)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

	ini_set('display_errors', 1);
	error_reporting(~0);
	date_default_timezone_set('Asia/Bangkok');

	$serverName = "RK-168N\SQLEXPRESS";
	$userName = "";
	$userPassword = '';
	$dbName = "demo";
  
   
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	if($conn)
	{
		echo "Database Connected.";
	}
	else
	{
		echo "Database Connect Failed.";
	}

	$conn = null;
?>
</body>
</html>