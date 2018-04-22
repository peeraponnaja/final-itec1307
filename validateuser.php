<html>
<head>
<script language="JavaScript" type="text/JavaScript">
function updateUser(username){ // #1
var ajaxUser = document.getElementById("userinfo"); // #2
ajaxUser.innerHTML = "<a href=\"logout.php\">Log Out</a>";
}
</script>
</head>

<body>
<?php
include('topmenu.php');
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
$connect = mysqli_connect("localhost", "root", "", "shopping") or die("Please, check your server connection.");
$query = "SELECT email_address, password, complete_name FROM customers WHERE
email_address like '" . $_POST['emailaddress'] . "' " .
"AND password like (PASSWORD('" . $_POST['password'] . "'))";
$result = mysqli_query($connect, $query) or die(mysql_error()); // #3
if (mysqli_num_rows($result) == 1) {
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
extract($row);
echo "Welcome " . $complete_name . " to our Shopping Mall <br>"; // #4
$_SESSION['emailaddress'] = $_POST['emailaddress'];
$_SESSION['password'] = $_POST['password'];
echo "<SCRIPT LANGUAGE=\"JavaScript\">updateUser('$complete_name');
</SCRIPT>"; // #5
}
}
else {
?>
Invalid Email address and/or Password<br> // #6
Not registered?
<a href="validatesignup.php">Click here</a> to register.<br><br><br>
Want to Try again<br>
<a href="signin.php">Click here</a> to try login again.<br>
<?php
}
?>
</body>
</html>