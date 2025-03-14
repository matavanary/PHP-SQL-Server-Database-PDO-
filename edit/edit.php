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
<form action="save.php" name="frmAdd" method="post">
<table width="284" border="1">
  <tr>
    <th width="120">CustomerID</th>
    <td width="238"><input type="hidden" name="txtCustomerID" value="<?php echo $result["CustomerID"];?>"><?php echo $result["CustomerID"];?></td>
    </tr>
  <tr>
    <th width="120">Name</th>
    <td><input type="text" name="txtName" size="20" value="<?php echo $result["Name"];?>"></td>
    </tr>
  <tr>
    <th width="120">Email</th>
    <td><input type="text" name="txtEmail" size="20" value="<?php echo $result["Email"];?>"></td>
    </tr>
  <tr>
    <th width="120">CountryCode</th>
    <td><input type="text" name="txtCountryCode" size="2" value="<?php echo $result["CountryCode"];?>"></td>
    </tr>
  <tr>
    <th width="120">Budget</th>
    <td><input type="text" name="txtBudget" size="5" value="<?php echo $result["Budget"];?>"></td>
    </tr>
  <tr>
    <th width="120">Used</th>
    <td><input type="text" name="txtUsed" size="5" value="<?php echo $result["Used"];?>"></td>
    </tr>
  </table>
  <input type="submit" name="submit" value="submit">
</form>
<?php
$conn = null;
?>
</body>
</html>