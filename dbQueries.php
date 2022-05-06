<!DOCTYPE html>
<html>
	<head>
		<title>dbQueries</title>
	</head>
	<body>
		<?php
			// connects to a database for me, but will need to be edited
			// to connect on your device and for the right database.
			include "db_connect.php";

			$errorMessage = "<script>alert(\"Sorry, we don't seem to have what you're looking for here.\");</script>";

			// Get all courses taken by a specific student in a specified semester.
			if(isset($_GET['sname']) && !empty($_GET['sname']) && $_GET['queryType'] == 'query1')
			{
				$sname = $_GET['sname'];
				$semester = $_GET['semester'];
				$sem_year = $_GET['semester_year'];
				$sql = "h";// Need to insert query here, blank atm since I can't test it.
				$result = $mysqli->query($sql);

				if($result->num_rows)
				{
					echo "<table style=\"padding-top:20px;\">
							<tr>
								<td><b>Course ID</b></td>
								<td><b>Course Name</b></td>
								<td><b>Time</b></td>
								<td><b>Location</b></td>
							</tr>";
					while($row = $result->fetch_assoc())
					{
						echo "<tr>
								<td>" . $row['cid'] . "</td>
								<td>" . $row['cname'] . "</td>
								<td>" . $row['meets_at'] . "</td>
								<td>" . $row['room'] . "</td>
							  </tr>";
					}
					echo "</table>";
				}
				else
				{
					echo $errorMessage;
				}
			}
			// Get all courses taught by a faculty member in a specified semester.
			if(isset($_GET['fname']) && !empty($_GET['fname']) && $_GET['queryType'] == 'query2')
			{
				$fname = $_GET['fname'];
				$semester = $_GET['semester'];
				$sem_year = $_GET['semester_year'];
				$sql = "h";// Need to insert query here, blank atm since I can't test it.
				$result = $mysqli->query($sql);

				if($result->num_rows)
				{
					echo "<table style=\"padding-top:20px;\">
							<tr>
								<td><b>Course ID</b></td>
								<td><b>Course Name</b></td>
								<td><b>Time</b></td>
								<td><b>Location</b></td>
							</tr>";
					while($row = $result->fetch_assoc())
					{
						echo "<tr>
								<td>" . $row['cid'] . "</td>
								<td>" . $row['cname'] . "</td>
								<td>" . $row['meets_at'] . "</td>
								<td>" . $row['room'] . "</td>
							  </tr>";
					}
					echo "</table>";
				}
				else
				{
					echo $errorMessage;
				}
			}
			// Get all students enrolled in a specified course in a specified semester
			if(isset($_GET['cname']) && !empty($_GET['cname']) && $_GET['queryType'] == 'query3')
			{
				$cname = $_GET['sname'];
				$semester = $_GET['semester'];
				$sem_year = $_GET['semester_year'];
				$sql = "h";// Need to insert query here, blank atm since I can't test it.
				$result = $mysqli->query($sql);

				if($result->num_rows)
				{
					echo "<table style=\"padding-top:20px;\">
							<tr>
								<td><b>Student ID</b></td>
								<td><b>Student Name</b></td>
								<td><b>Major</b></td>
								<td><b>Level</b></td>
							</tr>";
					while($row = $result->fetch_assoc())
					{
						echo "<tr>
								<td>" . $row['sid'] . "</td>
								<td>" . $row['sname'] . "</td>
								<td>" . $row['major'] . "</td>
								<td>" . $row['level'] . "</td>
							  </tr>";
					}
					echo "</table>";
				}
				else
				{
					echo $errorMessage;
				}
			}
		?>

		<form id="form1" method="GET">
				<input type="text" name="sname" placeholder="Enter Student Name..."><br>
				<input type="text" name="fname" placeholder="Enter Faculty Name..."><br>
				<input type="text" name="cname" placeholder="Enter Course Name..."><br>
				<select name="semester">
					<option value="spring">Spring</option>
					<option value="summer">Summer</option>
					<option value="fall">Fall</option>
				</select><br>
				<select name="semester_year">
					<option value="2024">2024</option>
					<option value="2023">2023</option>
					<option value="2022">2022</option>
					<option value="2021">2021</option>
					<option value="2020">2020</option>
					<option value="2019">2019</option>
					<option value="2018">2018</option>
					<option value="2017">2017</option>
					<option value="2016">2016</option>
					<option value="2015">2015</option>
				</select><br>
				<select name="queryType">
					<option value="query1">Print student's courses</option>
					<option value="query2">Print faculty member's taught courses</option>
					<option value="query3">Print class roster</option>
				</select><br>


				<input type="submit">
		</form>
	</body>
</html>