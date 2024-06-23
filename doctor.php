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
<br>
<center><h2>Doctor page</h2></center>
<hr color="00c020">
<br>
<body style="background-color:c0ffc0;color:#000000;">
<form action="doctor.php" method="post" style="alignment-adjust:auto; text-align:center">
<B>
<p>Name: <input name = "docname" id="docname" type = "text" placeholder="type here" size = "25" maxlength = "30" /><p/>

<p> Specialization: <input name = "docspecial" id="docspecial" type = "text" placeholder="type here" size = "25" maxlength = "30" /> <p/>

<p> Telephone Number: <input name = "docphone" id="docphone" type = "text" placeholder="type here" size = "25" maxlength = "30" /> <p/>

<p> Email: <input name = "docmail" id="docmail" type="Email" placeholder="type here" size = "25" maxlength = "30" /> <p/>

<p> Password: <input name = "docpass" id="docpass" type="text" placeholder="type here" size = "25" maxlength = "30" /> <p/>
<p> Clinic: 
	<select name = "docclinic" id="docclinic">
		<?php
			$mysqli = new mysqli("localhost", "root", "", "hospital");
			if ($result = $mysqli->query("SELECT ID,name FROM clinic ORDER BY id"))
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						echo "<option value='" . $row->ID . "'>" . $row->name . "</option>";
					}
				}
			}
			$mysqli->close();
		?>
	</select>
 <p/>

</B>

<br>
<input type = "submit" value = "Register" />
<?php
	if(isset($_GET['delID']))
	{
		$mysqli = new mysqli("localhost", "root", "", "hospital");
		$query = "DELETE FROM doctor WHERE ID=".$_GET['delID'];
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
	if(isset($_POST['docname']))
	{
		$query = "INSERT INTO doctor (Name,Specialization,Telephonenumber,Email,ClinicID,Password) VALUES ('$_POST[docname]','$_POST[docspecial]','$_POST[docphone]','$_POST[docmail]','$_POST[docclinic]','$_POST[docpass]')";
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
	if ($result1 = $mysqli->query("SELECT d.ID,d.Name,Specialization,Telephonenumber,Email,c.name FROM doctor d,clinic c Where d.ClinicID=c.ID ORDER BY ID"))
	{
	// display records if there are records to display
		if ($result1->num_rows > 0)
		{
			// display records in a table
			echo "<table border='1' cellpadding='10'>";

			// set table headers
			echo "<tr><th>#</th><th>#</th><th>Name</th><th>Specialization</th><th>Phone</th><th>Email</th><th>Clinic</th></tr>";

			while ($row = $result1->fetch_object())
			{
				// set up a row for each record
				echo "<tr>";
				echo "<td><a href='doctor.php?delID=" . $row->ID . "'>delete</a></td>";
				echo "<td>" . $row->ID . "</td>";
				echo "<td>" . $row->Name . "</td>";
				echo "<td>" . $row->Specialization . "</td>";
				echo "<td>" . $row->Telephonenumber . "</td>";
				echo "<td>" . $row->Email . "</td>";
				echo "<td>" . $row->name . "</td>";
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
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>
<!-- End Content Div-->
<?php include("page2.php"); ?>