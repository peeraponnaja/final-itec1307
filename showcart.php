<?php
    if ( ! isset($totalamount)) {
    $totalamount=0;
    }
    $totalquantity=0;
    if (!session_id()) {
    session_start();
    }
    $connect = mysqli_connect("localhost", "root", "", "shopping") or
    die("Please, check your server connection.");
    $sessid = session_id();
    $query = "SELECT * FROM cart WHERE cart_sess = '$sessid'";
    $results = mysqli_query($connect, $query) or die (mysql_query());
    if(mysqli_num_rows($results)==0)
    {
    echo "<div style=\"width:200px; margin:auto;\">Your Cart is empty</div> ";
    }
    else
    {
    ?>
    <table border="1" align="center" cellpadding="5">
    <tr><td> Item Code</td><td>Quantity</td><td>Item Name</td><td>Price</
    td><td>Total Price</td>
    <?php
    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
    extract($row);
    echo "<tr><td>";
    echo $cart_itemcode;
    echo "</td>";
    echo "<td><form method=\"POST\" action=\"cart.php?action=change&icode=$cart_itemcode\"><input type=\"text\" name=\"modified_quantity\" size=\"2\"
    value=\"$cart_quantity\">";
    echo "</td><td>";
    echo $cart_item_name;
    echo "</td><td>";
    echo $cart_price;
    echo "</td><td>";
    $totalquantity = $totalquantity + $cart_quantity;
    $totalprice = number_format($cart_price * $cart_quantity, 2);
    $totalamount=$totalamount + ($cart_price * $cart_quantity);
    echo $totalprice;
    echo "</td><td>";
    echo "<input type=\"submit\" name=\"Submit\" value=\"Change quantity\">
    </form></td>";
    echo "<td>";
    echo "<form method=\"POST\" action=\"cart.php?action=delete&icode=$cart_itemcode\">";
    echo "<input type=\"submit\" name=\"Submit\" value=\"Delete Item\"></form>
    </td></tr>";
    }
    echo "<tr><td >Total</td><td>$totalquantity</td><td></td><td></td><td>";
    $totalamount = number_format($totalamount, 2);
    echo $totalamount;
    echo "</table><br>";
    echo "</td></tr>";
    echo "<div style=\"width:400px; margin:auto;\">You currently have " .
    $totalquantity . " product(s) selected in your cart</div> ";
    ?>
    <table border="0" style="margin:auto;">
    <tr><td style="padding: 10px;">
    <form method="POST" action="cart.php?action=empty">
    <input type="submit" name="Submit" value="Empty Cart"
    style="font-family:verdana; font-size:150%;" >
    </form>
    </td><td>
    <form method="POST" action="checklogin.php">
    <input id="cartamount" name="cartamount" type="hidden" value= "<?php echo $totalamount ; ?>">
    <input type="submit" name="Submit" value="Checkout" style="font-family:verdana; font-size:150%;" >
    </form>
    </td></tr></table>
    <?php
    }
    ?>
    </body>
</html>