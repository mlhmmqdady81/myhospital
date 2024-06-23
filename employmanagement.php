<?php
// Start the session
session_start();
?>
<?php include("page1.php"); ?>
<!-- Content Div-->
<div class="content">
<?php
			if (!isset($_SESSION['EID']))
			{
				header("Location: http://localhost/hospital001/em_login.php");
			}
		?>
<br><center><h2>Employee Management</h2></center>
<hr color="00c020">

<br>
<div style="color:#000; font-size:16px; font-family:'Times New Roman', Times, serif; margin:0 auto; padding-left:20px; text-align:left;">


<form action="employmanagement.php" style="text-align:center;"  method="post">

<p>Name: <input name = "empname" id="empname" type = "text" placeholder="Name" size = "25" maxlength = "30" /><p/>
<p>Password: <input name = "emppass" id="emppass" type = "text" placeholder="Name" type="password" size = "25" maxlength = "30" /><p/>


<input type = "submit" value = "Register" />
<?php
	if(isset($_GET['delID']))
	{
		$mysqli = new mysqli("localhost", "root", "", "hospital");
		$query = "DELETE FROM employee WHERE ID=".$_GET['delID'];
		if($mysqli->query($query)==true)
		{	
			printf ("Record has deleted");
		}
		else
		{
			printf("Error in inserting data!Check your input.");
		}
		$mysqli->close();
	}
?>
<?php
	$mysqli = new mysqli("localhost", "root", "", "hospital");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	if(isset($_POST['empname']))
	{
		$query = "INSERT INTO employee (Name,password) VALUES ('$_POST[empname]','$_POST[emppass]')";
		if($mysqli->query($query)==true)
		{	
			printf ("New Record has added");
		}
		else
		{
			printf("Error in inserting data!Check your input.");
		}
	}


	/* close connection */
	//$mysqli->close();
	
?>
</center>
</B>

<p><b>View All</b> </p>
<?php
// connect to the database
	// get the records from the database
	if ($result = $mysqli->query("SELECT * FROM employee ORDER BY ID"))
	{
	// display records if there are records to display
		if ($result->num_rows > 0)
		{
			// display records in a table
			echo "<table border='1' cellpadding='10'>";

			// set table headers
			echo "<tr><th>#</th><th>#</th><th>Name</th></tr>";

			while ($row = $result->fetch_object())
			{
				// set up a row for each record
				echo "<tr>";
				echo "<td><a href='employmanagement.php?delID=" . $row->ID . "'>delete</a></td>";
				echo "<td>" . $row->ID . "</td>";
				echo "<td>" . $row->Name . "</td>";
				echo "</tr>";
			}

			echo "</table>";
		}
		// if there are no records in the database, display an alert message
		else
		{
			echo "No results to display!";
		}
	}
	$mysqli->close();
?>

</form>
</div>
<!-- End Content Div-->
<?php include("page2.php"); ?>