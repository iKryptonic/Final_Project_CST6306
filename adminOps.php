<!DOCTYPE html>
<html>
	<head>
		<title>adminOps</title>
	</head>
	<body>
		<?php

			/*I apologize in advance for how sloppy this code is,
			As is probably obvious the 'cleaning it up' phase is still
			a work in progress. Main thing at this point is figuring out 
			how we want SQL queries to be performed, while minimizing interface
			complexity. Feel free to edit and critique.*/

			// connects to a database for me, but will need to be edited
			// to connect on your device and for the right database.
			include "db_connect.php";


			if(isset($_GET['table']) && isset($_GET['adminQuery']))
			{
				$table = $_GET['table'];
				$adminQ = $_GET['adminQuery'];
			}

			if($table == "Student")
			{
				if($adminQ == "INSERT")
				{

				}
				else if($adminQ == "DELETE")
				{
					
				}
				else if($adminQ == "UPDATE")
				{
					
				}
			}

			// I am very sure there is a less tedious manner of formulating these queries,
			// I just have yet to hit upon it. The combinations of table and statement make
			// for a good number. Stopped here in case the database portion can simplify this/save typing.
			if($table == "Course")
			{
				
				if($adminQ == "INSERT" && isset($_GET['cid']) && !empty($_GET['cid']) && isset($_GET['cname']) && !empty($_GET['cname']) && isset($_GET['meets_at']) && !empty($_GET['meets_at']) && isset($_GET['room']) && !empty($_GET['room']))
				{
					$cid = $_GET['cid'];
					$cname = $_GET['cname'];
					$meets_at = $_GET['meets_at'];
					$room = $_GET['room'];

					$sql = "INSERT INTO `databaseNameHere`.`Course` 
						(
							`cid`, 
							`cname`, 
							`meets_at`, 
							`room`
						) 
						VALUES 
						(
							".$cid.", 
							'".$cname."', 
							'".$meets_at."', 
							'".$room."'
						) 
						ON DUPLICATE KEY UPDATE 
							cid=".$cid.",
							cname='".$cname."',
							meets_at='".$meets_at."',
							room='".$room."'";

					$result = $mysqli->query($sql);

				}
				else if($adminQ == "DELETE" && isset($_GET['cid']) && !empty($_GET['cid']))
				{
					$cid = $_GET['cid'];

					$sql = "DELETE FROM `databaseNameHere`.`Course` 
						WHERE cid=".$cid;

					$result = $mysqli->query($sql);
				}
				else if($adminQ == "UPDATE" && isset($_GET['cid']) && !empty($_GET['cid']) && isset($_GET['cname']) && !empty($_GET['cname']) && isset($_GET['meets_at']) && !empty($_GET['meets_at']) && isset($_GET['room']) && !empty($_GET['room']))
				{
					$cid = $_GET['cid'];
					$cname = $_GET['cname'];
					$meets_at = $_GET['meets_at'];
					$room = $_GET['room'];

					$sql = "UPDATE `databaseNameHere`.`Course`  
						SET 
						( 
							cname='".$cname."', 
							meets_at='".$meets_at."', 
							room='".$room."'
						) 
						WHERE
							cid=".$cid;

					$result = $mysqli->query($sql);
				}
			}

			if($table == "Enrolled")
			{
				if($adminQ == "INSERT")
				{

				}
				else if($adminQ == "DELETE")
				{
					
				}
				else if($adminQ == "UPDATE")
				{
					
				}
			}

			if($table == "Faculty")
			{
				if($adminQ == "INSERT")
				{

				}
				else if($adminQ == "DELETE")
				{
					
				}
				else if($adminQ == "UPDATE")
				{
					
				}
			}

			if($table == "Offered")
			{
				if($adminQ == "INSERT")
				{

				}
				else if($adminQ == "DELETE")
				{
					
				}
				else if($adminQ == "UPDATE")
				{
					
				}
			}

		?>
		<script>
			/*This script basically is just making sure you only see 
			the input for whatever table you plan on operating on.*/
			function reveal(form)
			{
				document.getElementById(form).style.display="block";
			}
			function hide(form)
			{
				document.getElementById(form).style.display="none";
			}
			function queryInput()
			{
				hide("studentForm");
				hide("courseForm");
				hide("enrolledForm");
				hide("facultyForm");
				hide("offeredForm");

				var table = "<?php echo $table;?>";
				
				if(table == "Student")
				{
					reveal("studentForm");
				}
				else if(table == "Course")
				{
					reveal("courseForm");
				}
				else if(table == "Enrolled")
				{
					reveal("enrolledForm");
				}
				else if(table == "Faculty")
				{
					reveal("facultyForm");
				}
				else if(table == "Offered")
				{
					reveal("offeredForm");
				}
			}
		</script>
		<form id="form1" method="GET">
			<label><b>Statement Type:</b></label>
			<select name="adminQuery">
				<option value="INSERT">Insert entry</option>
				<option value="DELETE">Delete entry</option>
				<option value="UPDATE">Update entry</option>
			</select><br>
			<label><b>Table:</b></label>
			<select name="table">
				<option value="Student">Student</option>
				<option value="Course">Course</option>
				<option value="Enrolled">Enrolled</option>
				<option value="Faculty">Faculty</option>
				<option value="Offered">Offered</option>
			</select><br>

			<input type="submit">
		</form>

		<form id="studentForm" style="display:none;">
			<label><b>sid:</b></label>
			<input type="number" name="sid" placeholder="..."><br>
			<label><b>sname:</b></label>
			<input type="text" name="sname" placeholder="..."><br>
			<label><b>major:</b></label>
			<input type="text" name="major" placeholder="..."><br>
			<label><b>level:</b></label>
			<input type="text" name="level" placeholder="..."><br>
			<label><b>byear:</b></label>
			<input type="number" name="byear" placeholder="..."><br>

			<input type="submit" value="Execute Query">
		</form>

		<form id="courseForm" style="display:none;">
			<label><b>cid:</b></label>
			<input type="number" name="cid" placeholder="..."><br>
			<label><b>cname:</b></label>
			<input type="text" name="cname" placeholder="..."><br>
			<label><b>meets_at:</b></label>
			<input type="text" name="meets_at" placeholder="..."><br>
			<label><b>room:</b></label>
			<input type="text" name="room" placeholder="..."><br>

			<input type="submit" value="Execute Query">
		</form>

		<form id="enrolledForm" style="display:none;">
			<label><b>sid:</b></label>
			<input type="number" name="sid_e" placeholder="..."><br>
			<label><b>oid:</b></label>
			<input type="number" name="oid" placeholder="..."><br>

			<input type="submit" value="Execute Query">
		</form>

		<form id="facultyForm" style="display:none;">
			<label><b>fid:</b></label>
			<input type="number" name="fid" placeholder="..."><br>
			<label><b>fname:</b></label>
			<input type="text" name="fname" placeholder="..."><br>
			<label><b>department:</b></label>
			<input type="text" name="department" placeholder="..."><br>

			<input type="submit" value="Execute Query">
		</form>

		<form id="offeredForm" style="display:none;">
			<label><b>oid:</b></label>
			<input type="number" name="oid_o" placeholder="..."><br>
			<label><b>cid:</b></label>
			<input type="number" name="cid_o" placeholder="..."><br>
			<label><b>fid:</b></label>
			<input type="number" name="fid_o" placeholder="..."><br>
			<label><b>semester:</b></label>
			<input type="text" name="semester" placeholder="..."><br>
			<label><b>fid:</b></label>
			<input type="number" name="year" placeholder="..."><br>

			<input type="submit" value="Execute Query">
		</form>
		<script>
			queryInput();
		</script>
	</body>
</html>