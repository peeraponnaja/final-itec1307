<html>
<head>
        <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    </head>
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
        $tmpr = 0;
        
    echo"<form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
        <input type='hidden' name='sid' value='901248156' />
        <input type='hidden' name='mode' value='2CO' /> ";
        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            extract($row);
            echo"<input type='hidden' name='li_{$tmpr}_type' value='product' />
                <input type='hidden' name='li_{$tmpr}_name' value='$cart_item_name' />
                <input type='hidden' name='li_{$tmpr}_quantity' value='$cart_quantity' />
                <input type='hidden' name='li_{$tmpr}_price' value='$cart_price' />";
                $tmpr  = $tmpr+1;
            
        }
    echo"
        <input type='hidden' name='card_holder_name' value='Checkout Shopper' />
        <input type='hidden' name='street_address' value='123 Test Address' />
        <input type='hidden' name='street_address2' value='Suite 200' />
        <input type='hidden' name='city' value='Columbus' />
        <input type='hidden' name='state' value='OH' />
        <input type='hidden' name='zip' value='43228' />
        <input type='hidden' name='country' value='USA' />
        <input type='hidden' name='email' value='example@2co.com' />
        <input type='hidden' name='phone' value='614-921-2450' />        
        <input name='submit' type='submit' value='Checkout' /> qwgqwgqwg 
        </form>";

?>
