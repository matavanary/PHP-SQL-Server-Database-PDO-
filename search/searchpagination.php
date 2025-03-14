<html>
<head>
<title>ThaiCreate.Com PHP & SQL Server (PDO)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$strKeyword = null;

	if(isset($_POST["txtKeyword"]))
	{
		$strKeyword = $_POST["txtKeyword"];
	}
	if(isset($_GET["txtKeyword"]))
	{
		$strKeyword = $_GET["txtKeyword"];
	}
?>
<form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
  <table width="599" border="1">
    <tr>
      <th>Keyword
      <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
      <input type="submit" value="Search"></th>
    </tr>
  </table>
</form>
<?php
   include("../connect/connect.php");
  
   
    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

	$sql = "SELECT COUNT(*) FROM customer WHERE Name LIKE '%".$strKeyword."%' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

	$num_rows = $stmt->fetchColumn();

	$per_page = 2;   // Per Page
	$page  = 1;
	
	if(isset($_GET["Page"]))
	{
		$page = $_GET["Page"];
	}

	$prev_page = $page-1;
	$next_page = $page+1;

	$row_start = (($per_page*$page)-$per_page);
	if($num_rows<=$per_page)
	{
		$num_pages =1;
	}
	else if(($num_rows % $per_page)==0)
	{
		$num_pages =($num_rows/$per_page) ;
	}
	else
	{
		$num_pages =($num_rows/$per_page)+1;
		$num_pages = (int)$num_pages;
	}
	$row_end = $per_page * $page;
	if($row_end > $num_rows)
	{
		$row_end = $num_rows;
	}


	$sql = " SELECT c.* FROM (
		SELECT ROW_NUMBER() OVER(ORDER BY CustomerID) AS RowID,*  FROM customer  WHERE Name LIKE '%".$strKeyword."%'
		) AS c 
	WHERE c.RowID > $row_start AND c.RowID <= $row_end
	";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">CustomerID </div></th>
    <th width="98"> <div align="center">Name </div></th>
    <th width="198"> <div align="center">Email </div></th>
    <th width="97"> <div align="center">CountryCode </div></th>
    <th width="59"> <div align="center">Budget </div></th>
    <th width="71"> <div align="center">Used </div></th>
  </tr>
<?php
while($result = $stmt->fetch( PDO::FETCH_ASSOC ))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["CustomerID"];?></div></td>
    <td><?php echo $result["Name"];?></td>
    <td><?php echo $result["Email"];?></td>
    <td><div align="center"><?php echo $result["CountryCode"];?></div></td>
    <td align="right"><?php echo $result["Budget"];?></td>
    <td align="right"><?php echo $result["Used"];?></td>
  </tr>
<?php
}
?>
</table>
<br>
Total <?php echo $num_rows;?> Record : <?php echo $num_pages;?> Page :
<?php
if($prev_page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$prev_page&txtKeyword=$strKeyword'><< Back</a> ";
}

for($i=1; $i<=$num_pages; $i++){
	if($i != $page)
	{
		echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i&txtKeyword=$strKeyword'>$i</a> ]";
	}
	else
	{
		echo "<b> $i </b>";
	}
}
if($page!=$num_pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$next_page&txtKeyword=$strKeyword'>Next>></a> ";
}
$conn = null;
?>
</body>
</html>