<?php
// Start the session
session_start();
?>

<?php include("page1.php"); ?>
<!-- Content Div-->
<div class="content">
<br><center><h2>Reservation</h2></center>
<hr color="00c020">
		<?php
			if (!isset($_SESSION['DID']))
			{
				header("Location: http://localhost/hospital001/dc_login.php");
			}
		?>
<body style="background-color:c0ffc0;color:#000000;">

<form action="ListReservation.php" method="post">
<?php
	//Delete a record from the database
	//Check the query for an ID to delete
	if(isset($_GET['delID']))
	{
		$mysqli = new mysqli("localhost", "root", "", "hospital");
		$query = "DELETE FROM schedule WHERE SID=".$_GET['delID'];
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
<center>
<p><b>Your Reservations</b> </p>
<?php
// connect to the database
$mysqli = new mysqli("localhost", "root", "", "hospital");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	// get the records from the database
	if ($result1 = $mysqli->query("SELECT SID,SDate,Name,Note FROM schedule s,patient p Where DoctorID=$_SESSION[DID] and p.ID=s.PitientID ORDER BY SID"))
	{
	// display records if there are records to display
		if ($result1->num_rows > 0)
		{
			// display records in a table
			echo "<table border='1' cellpadding='10'>";

			// set table headers
			echo "<tr><th>#</th><th>Date</th><th>Paitant</th><th>Note</th></tr>";

			while ($row = $result1->fetch_object())
			{
				// set up a row for each record
				echo "<tr>";
				echo "<td><a href='ListReservation.php?delID=" . $row->SID . "'>delete</a></td>";
				echo "<td>" . $row->SDate . "</td>";
				echo "<td>" . $row->Name . "</td>";
				echo "<td>" . $row->Note . "</td>";
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
<center/>

</form>
</B>
<br /><br /><br />
</div>
<!-- End Content Div-->
<?php include("page2.php"); ?>