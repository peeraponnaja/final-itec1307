<?php
include('topmenu.php');
echo"<html lang='en'>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Bootstrap 101 Template</title>
  <link href='css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>

  <div class='row'>";
$connect = mysqli_connect("localhost", "root", "", "shopping") or
die("Please, check your server connection.");
$category=$_REQUEST['category'];
$query = "SELECT item_code, item_name, description, imagename, price FROM
products " .
"where category like '$category' order by item_code";
$results = mysqli_query($connect, $query) or die(mysql_error());

while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {

extract($row);
echo"<div class='col-xs-6 col-md-3'>";
echo "<a href=itemdetails.php?itemcode=$item_code  class='thumbnail'>"; // #2
echo '<img src=' . $imagename . ' style="max-width:230px;max-height:180px;
width:auto;height:auto;"></img>';
echo $item_name .'<br/>';
echo '$'.$price .'<br/>';
echo "</a>";
echo "</div>";
}
?>
</div>
</body>
</html>