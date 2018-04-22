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
<body>";

    $connect = mysqli_connect("localhost", "root", "", "shopping") or
    die("Please, check your server connection.");
    $code=$_REQUEST['itemcode'];
    $query = "SELECT item_code, item_name, description, imagename, price FROM
    products " .
    "where item_code like '$code'";
    $results = mysqli_query($connect, $query) or die(mysql_error()); // #1
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    extract($row);
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">";    
    echo "<tr><td style=\"padding: 30px;\" rowspan=\"6\">";
    echo '<img src=' . $imagename . ' style="max-width:300px;max-height:450px;
    width:auto;height:auto;"  class="img-thumbnail"></img></td>';
    echo "<td colspan=\"2\" align=\"center\" style=\"font-family:verdana;
    font-size:120%;\"><b>";    
    echo "<h3>$item_name</h3>";    
    echo "</b></td></tr><tr><td colspan=\"1\"><table><tr>";


    $itemname=urlencode($item_name);
    $itemprice=$price;
    $itemdescription=$description;
    $pfquery = "SELECT feature1, feature2, feature3, feature4, feature5,
    feature6 FROM productfeatures " .
    "where item_code like '$code'"; // #2
    $pfresults = mysqli_query($connect, $pfquery) or die(mysql_error());
    $pfrow = mysqli_fetch_array($pfresults, MYSQLI_ASSOC);
    extract($pfrow);


    echo "</td></tr><tr><td>";
    echo $feature1;  
    echo "</td><td>";
    echo $feature2;
    echo "</td></tr><tr><td>";
    echo $feature3;
    echo "</td><td>";
    echo $feature4;
    echo "</td></tr><tr><td>";
    echo $feature5;
    echo "</td><td>";
    echo $feature6;
    echo "</td></tr><tr>";
    echo "<form method=\"POST\" action=\"cart.php?action=add&icode=$item_code&iname=$itemname&iprice=$itemprice\">";
    echo "<td colspan=\"2\" style=\"font-family:verdana; font-size:150%;\">";
    echo " Quantity: <input type=\"text\" name=\"quantity\" size=\"2\" value = 1>&nbsp;&nbsp;
    &nbsp;Price: " . $itemprice;
    echo "</td></tr><tr><td colspan=\"2\"><button type=\"submit\" class=\"btn btn-default\"
    name=\"buynow\" style=\"font-size:150%;\">Buy Now";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type=\"submit\" class=\"btn btn-default\"
    name=\"addtocart\" value=\"\" style=\"font-size:150%;\">Add To Cart</td>";
    echo" </form>";
    echo "</tr></table></table>";
    echo "<p style=\"font-size:140%;\">Description</p>";
    echo "$itemdescription";
?>
</body>
</html>