<?php
    include('topmenu.php');
?>
<html>
<head>
</head>
    <body>
    <form action="validateuser.php" method="post">
    <table border="0" cellspacing="1" cellpadding="3">
    <label for="exampleInputEmail1">Email address</label>
    <form action="validateuser.php" method="post">
  <div>
    <input type="email" class="form-group" id="exampleInputEmail1" placeholder="Email" name="emailaddress">
  </div>
  <label for="exampleInputPassword1">Password</label>
  <div class="form-group">
    
    <input type="password" class="form-group" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>  
  <button type="submit" class="btn btn-default">Login</button>
</form>
</html>