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
			if (!isset($_SESSION['PID']))
			{
				header("Location: http://localhost/hospital001/pa_login.php");
			}
			?>
<body style="background-color:c0ffc0;color:#000000;">

<form action="MakeReservation.php" method="post">
<br>
<center>
<p> Doctor: 
	<select name = "sdoctor" id="sdoctor">
		<?php
			$mysqli = new mysqli("localhost", "root", "", "hospital");
			if ($result = $mysqli->query("SELECT d.ID,d.Name,c.name as 'ClinicName' FROM doctor d, clinic c Where  d.ClinicID=c.IDORDER BY d.ID"))
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						echo "<option value='" . $row->ID . "'>" . $row->Name . " - " . $row->ClinicName . "</option>";
					}
				}
			}
			$mysqli->close();
		?>
	</select>
 <p/>
 <p>Date: <input name="pemail" id="pemail" type = "date" placeholder="type here" size = "25" maxlength = "30" /> </p>
<p>Note:  <textarea name="snote" id="snote" rows = "4" cols = "36" placeholder="type here"> </textarea>  </p>

<br>
<input type = "submit" value = "Register" />
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
<?php
	$mysqli = new mysqli("localhost", "root", "", "hospital");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	if(isset($_SESSION['PID']) && isset($_POST['snote']) )
	{
		$query = "INSERT INTO schedule (SDate,DoctorID,PitientID,Note) VALUES ('$_POST[pemail]',$_POST[sdoctor],$_SESSION[PID],'$_POST[snote]')";
		if($mysqli->query($query)==true)
		{	
			printf ("New Record has added");
		}
		else
		{
			printf("Error in inserting data!Check your input.");
		}
	}
?>

<p><b>View All</b> </p>
<?php
// connect to the database
	// get the records from the database
	if ($result1 = $mysqli->query("SELECT SID,SDate,Name,c.name as 'ClinicName',PitientID,Note FROM schedule s,doctor d, clinic c Where PitientID=$_SESSION[PID] and d.ID=s.DoctorID and d.ClinicID=c.ID ORDER BY SID"))
	{
	// display records if there are records to display
		if ($result1->num_rows > 0)
		{
			// display records in a table
			echo "<table border='1' cellpadding='10'>";

			// set table headers
			echo "<tr><th>#</th><th>#</th><th>Date</th><th>Doctor</th><th>Clinic Name</th><th>Note</th></tr>";

			while ($row = $result1->fetch_object())
			{
				// set up a row for each record
				echo "<tr>";
				echo "<td><a href='MakeReservation.php?delID=" . $row->SID . "'>Cancel</a></td>";
				echo "<td>" . $row->SID . "</td>";
				echo "<td>" . $row->SDate . "</td>";
				echo "<td>" . $row->Name . "</td>";
				echo "<td>" . $row->ClinicName . "</td>";
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