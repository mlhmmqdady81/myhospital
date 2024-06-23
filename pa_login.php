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
<form style="text-align:center;" action="pa_login.php" method="post">
<?php
	$mysqli = new mysqli("localhost", "root", "", "hospital");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	if(isset($_POST['pname']))
	{
			if ($result1 = $mysqli->query("SELECT ID,Password FROM patient WHERE Name='$_POST[pname]' ORDER BY ID"))
			{
			// display records if there are records to display
				if ($result1->num_rows > 0)
				{
					while ($row = $result1->fetch_object())
					{
						
						if($row->Password==$_POST['ppaswword'])
						{
							$_SESSION["PID"] = $row->ID;
							header("Location: http://localhost/hospital001/MakeReservation.php");
						}
						else
							echo "Wrong Data!";
					}
				}echo "Wrong Data!";
			}
	}

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