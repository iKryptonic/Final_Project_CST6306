<!DOCTYPE html>
<html>
	<head>
		<title>dbQueries</title>
		<style> 
			Body {
				font-family: Calibri, Helvetica, sans-serif;
				background-color: white;
			}
			form { 
				border: 3px solid #f1f1f1; 
			}
			input[type=text] { 
				width: 100%; 
				margin: 8px 0;
				padding: 12px 20px; 
				display: inline-block; 
				border: 2px solid green; 
				box-sizing: border-box; 
			}
			input[type=submit] { 
				background-color: #4CAF50; 
				width: 100%;
				color: white; 
				padding: 15px; 
				margin: 10px 0px; 
				border: none; 
				cursor: pointer; 
			}
			input[type=submit]:hover { 
				opacity: 0.7; 
			}	
			.container { 
				padding: 25px; 
				background-color: lightblue;
			}
		</style>
	</head>
	<h1> CS Course Management System </h1>
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
				$sql = "CALL `get_student_courses_by_semester`('$sname', '$semester', '$sem_year');";
				$result = $conn->query($sql);

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
				$sql = "CALL `get_faculty_courses_by_semester`('$fname', '$semester', '$sem_year');";
				$result = $conn->query($sql);

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
				ini_set('display_errors', 1); 
				ini_set('display_startup_errors', 1); 
				error_reporting(E_ALL);
				$cname = $_GET['cname'];
				$semester = $_GET['semester'];
				$sem_year = intval($_GET['semester_year']);
				$sql = "CALL get_course_students_by_semester('$cname', '$semester', '$sem_year')";
				
				$result = $conn->query($sql);
				
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
			<div class="container">
				<input type="text" name="sname" placeholder="Enter Student Name..."><br>
				<input type="text" name="fname" placeholder="Enter Faculty Name..."><br>
				<input type="text" name="cname" placeholder="Enter Course Name..."><br>
				<select name="semester">
					<option value="Spring">Spring</option>
					<option value="Summer">Summer</option>
					<option value="Fall">Fall</option>
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
			</div>
		</form>
	</body>
</html>
