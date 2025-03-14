<html>
<head>
<title>ThaiCreate.Com PHP & SQL Server (PDO)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$strCustomerID = null;

	if(isset($_GET["CustomerID"]))
	{
		$strCustomerID = $_GET["CustomerID"];
	}

    include("../connect/connect.php");

	
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	$sql = "SELECT * FROM customer WHERE CustomerID = ? ";
	$params = array($strCustomerID);

	$stmt = $conn->prepare($sql);
	$stmt->execute($params);

	$result = $stmt->fetch( PDO::FETCH_ASSOC );

?>
<table width="284" border="1">
  <tr>
    <th width="120">CustomerID</th>
    <td width="238"><?php echo $result["CustomerID"];?></td>
    </tr>
  <tr>
    <th width="120">Name</th>
    <td><?php echo $result["Name"];?></td>
    </tr>
  <tr>
    <th width="120">Email</th>
    <td><?php echo $result["Email"];?></td>
    </tr>
  <tr>
    <th width="120">CountryCode</th>
    <td><?php echo $result["CountryCode"];?></td>
    </tr>
  <tr>
    <th width="120">Budget</th>
    <td><?php echo $result["Budget"];?></td>
    </tr>
  <tr>
    <th width="120">Used</th>
    <td><?php echo $result["Used"];?></td>
    </tr>
  </table>
<?php
$conn = null;
?>
</body>
</html>