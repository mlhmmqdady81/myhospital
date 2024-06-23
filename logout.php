<?php
// Start the session
session_start();
?>

<?php include("page1.php"); ?>
<!-- Content Div-->
<div class="content">
<br>
<center><h2>Login page</h2></center>
<hr color="00c020">

<br>


<body style="background-color:c0ffc0;color:#000000;">

<center>
<B>
<form style="text-align:center;" action="dc_login.php" method="post">
<?php
	unset($_SESSION["DID"]);// Unset the session to make logout of doctor
	unset($_SESSION["EID"]);// Unset the session to make logout of employ
	unset($_SESSION["PID"]);// Unset the session to make logout of paitant
	header("Location: http://localhost/hospital001/index.php");//Redirect to the home page
?>
<p>Name: <input name = "pname" id="pname" type = "text" placeholder="type here" size = "25" maxlength = "30" /><p/>
<p>Password: <input name = "ppaswword" id="ppaswword" type = "password" placeholder="type here" size = "25" maxlength = "30" /><p/>

<br>
<input type = "submit" value = "Login" />


</center>
</B>
</form>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>
<!-- End Content Div-->
<?php include("page2.php"); ?>