<?php
// Start the session
session_start();
?>
<?php include("page1.php"); ?>
<!-- Content Div-->
<div class="content">
<?php
			//if (!isset($_SESSION['EID']))
			//{
				//header("Location: http://localhost/hospital001/em_login.php");
			//}
		?>
<br><center><h2>Patient page</h2></center>
<hr color="00c020">

<br>

<form action="Patient.php" method="post" style="text-align:center;">

<body style="background-color:c0ffc0;color:#000000;">



<B>


<p>Patient name: <input name="pname" id="pname" type = "text" placeholder="type here" size = "25" maxlength = "30" /> </p>

<p>National Identity: <input name="pid" id="pid" type = "text" placeholder="type here" size = "25" maxlength = "30" /> </p>

<p>Telephone number: <input name="pphone" id="pphone" type = "text" placeholder="type here" size = "25" maxlength = "30" /></p>

<p>City: <input name="pcity" id="pcity" type = "text" placeholder="type here" size = "25" maxlength = "30" /> </p>

<p>Email: <input name="pemail" id="pemail" type = "email" placeholder="type here" size = "25" maxlength = "30" /> </p>

 
<p>History and New Diagnosis: <input name="phistory" id="phistory" type = "text" placeholder="type here" size = "25" maxlength = "30" /> </p>
 

<p>Comments: <br> <textarea name="pcomment" id="pcomment" rows = "4" cols = "36" placeholder="type here"> </textarea>  </p>



<p>Password: <input name="ppassword" id="ppassword" type = "text" placeholder="type here" size = "25" maxlength = "30" /> 




<br>
<input type = "submit" value = "Register" /></p>

<?php
	//Delete a record from the database
	//Check the query for an ID to delete
	if(isset($_GET['delID']))
	{
		$mysqli = new mysqli("localhost", "root", "", "hospital");
		$query = "DELETE FROM patient WHERE ID=".$_GET['delID'];
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
	if(isset($_POST['pname']))
	{
		$query = "INSERT INTO patient (Name,NationalityID,Telephonenumber,City,Email,comments,MedicalHistory,Password) VALUES ('$_POST[pname]','$_POST[pid]','$_POST[pphone]','$_POST[pcity]','$_POST[pemail]','$_POST[pcomment]','$_POST[phistory]','$_POST[ppassword]')";
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
	if ($result1 = $mysqli->query("SELECT ID,Name,NationalityID,Telephonenumber,City,Email,comments,MedicalHistory,Password FROM patient ORDER BY ID"))
	{
	// display records if there are records to display
		if ($result1->num_rows > 0)
		{
			// display records in a table
			echo "<table border='1' cellpadding='10'>";

			// set table headers
			echo "<tr><th>#</th><th>#</th><th>Name</th><th>NationalityID</th><th>Phone</th><th>City</th><th>Email</th><th>comments</th><th>MedicalHistory</th><th>Password</th></tr>";

			while ($row = $result1->fetch_object())
			{
				// set up a row for each record
				echo "<tr>";
				echo "<td><a href='Patient.php?delID=" . $row->ID . "'>delete</a></td>";
				echo "<td>" . $row->ID . "</td>";
				echo "<td>" . $row->Name . "</td>";
				echo "<td>" . $row->NationalityID . "</td>";
				echo "<td>" . $row->Telephonenumber . "</td>";
				echo "<td>" . $row->City . "</td>";
				echo "<td>" . $row->Email . "</td>";
				echo "<td>" . $row->comments . "</td>";
				echo "<td>" . $row->MedicalHistory . "</td>";
				echo "<td>" . $row->Password . "</td>";
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
</B>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>
<!-- End Content Div-->
<?php include("page2.php"); ?>