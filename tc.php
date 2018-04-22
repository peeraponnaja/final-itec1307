<head>
        <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    </head>
<?php
    include('topmenu.php');
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }
    $connect = mysqli_connect("localhost", "root", "", "shopping") or
    die("Please, check your server connection.");
    if (isset($_SESSION['emailaddress']))
    {
    $email_address=$_SESSION['emailaddress'];
    }
    if (isset($_SESSION['password']))
    {
    $password=$_SESSION['password'];
    }
    if ((isset($_SESSION['emailaddress']) && $_SESSION['emailaddress'] != "") ||
    (isset($_SESSION['password']) && $_SESSION['password'] != "")) {
    $sess = session_id();
    $query = "SELECT * FROM cart WHERE cart_sess = '$sess'";
    $result = mysqli_query($connect, $query) or die(mysql_error());
    $tmpr = 0;

    
    if(mysqli_num_rows($result)>=1)
    {
        $query = "SELECT * FROM customers WHERE email_address = '$email_address'";
        $result2 = mysqli_query($connect, $query) or die(mysql_error());
        $res = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        extract($res);

        $query = "SELECT * FROM orders";
        $tmpod = mysqli_query($connect, $query) or die(mysql_error());
        $orid = mysqli_num_rows($tmpod)+1;    
        $query = "INSERT INTO orders (order_no, order_date, email_address, customer_name, shipping_address_line1, shipping_address_line2, shipping_city, shipping_state, shipping_country, shipping_zipcode) 
        VALUES ('$orid',Now(),'$email_address', '$complete_name', '$address_line1','$address_line2','$city', '$state', '$country', '$zipcode')";   
        $tmpsave = mysqli_query($connect, $query) or die(mysql_error());

        echo"<form action='https://sandbox.2checkout.com/checkout/purchase' action='tc.php' method='post'>
            <input type='hidden' name='sid' value='901248156' />
            <input type='hidden' name='mode' value='2CO' /> ";
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                extract($row);
                $query = "INSERT INTO orders_details (order_no, item_code, item_name, quantity, price) 
                VALUES ('$orid','$cart_itemcode','$cart_item_name', '$cart_quantity', '$cart_price')";   
                $tmpsave = mysqli_query($connect, $query) or die(mysql_error());                
                echo"<input type='hidden' name='li_{$tmpr}_type' value='product' />
                    <input type='hidden' name='li_{$tmpr}_name' value='$cart_item_name' />
                    <input type='hidden' name='li_{$tmpr}_quantity' value='$cart_quantity' />
                    <input type='hidden' name='li_{$tmpr}_price' value='$cart_price' />";
                    $tmpr  = $tmpr+1;
            }
        echo"
        
            <input type='hidden' name='card_holder_name' value='$complete_name' />
            <input type='hidden' name='street_address' value='$address_line1' />
            <input type='hidden' name='street_address2' value='$address_line2' />
            <input type='hidden' name='city' value='$city' />
            <input type='hidden' name='state' value='$state' />
            <input type='hidden' name='zip' value='$zipcode' />
            <input type='hidden' name='country' value='$country' />
            <input type='hidden' name='email' value='$email_address' />
            <input type='hidden' name='phone' value='$cellphone_no' />        
            your order has been save and your cart now empty <input name='submit' type='submit' value='Click here' /> to supply ShippingInformation
            </form>";
        $query = "DELETE FROM cart";
        $results = mysqli_query($connect, $query) or die(mysql_error());
    echo " Or Context us ";
    }    
    ?>
    <html>
    <head>
    </head>
    </html>
    <?php
    }
?>
    
