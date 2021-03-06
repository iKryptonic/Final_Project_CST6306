<!DOCTYPE html>
<html>
	<head>
		<title>adminOps</title>
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
	
		<body>
		<h1> CS Course Management System </h1>
		<?php

			/*I apologize in advance for how sloppy this code is,
			As is probably obvious the 'cleaning it up' phase is still
			a work in progress. Main thing at this point is figuring out 
			how we want SQL queries to be performed, while minimizing interface
			complexity. Feel free to edit and critique.*/

			// connects to a database for me, but will need to be edited
			// to connect on your device and for the right database.
			include "db_connect.php";

		
			// This will check if a php value is valid
			function checkValue($val){
				return (isset($val) && !empty($val)) ? $val : null;
			}
			
			// Sanitize user input against HTML escapes
			$table = htmlspecialchars($_POST['table']);
			$adminQ = htmlspecialchars($_POST['adminQuery']);
		
			// request null check
			if((!checkValue($table) || !checkValue($adminQ)) && $_SERVER["REQUEST"]=="POST"){
				die("Invalid request parameters. \n" . "Missing parameters" . 
				   (!checkValue($table) ? "'table'\n" : "") .
				   (!checkValue($adminQ) ? "'adminQ'\n" : "")
				   );
			}
		
			// I am very sure there is a less tedious manner of formulating these queries,
			// I just have yet to hit upon it. The combinations of table and statement make
			// for a good number. Stopped here in case the database portion can simplify this/save typing.
		
			// IS: Swapped if statements to switch for readability
		
			$sql = ""; // an empty query
		
			switch($table){
				case "Course": {// Table = Course
						$cid = htmlspecialchars($_POST['cid']);
						$cname = htmlspecialchars($_POST['cname']);
						$meets_at = htmlspecialchars($_POST['meets_at']);
						$room = htmlspecialchars($_POST['room']);
						
						switch($adminQ){
							case "INSERT":	{		
								if(!checkValue($cid) || !checkValue($cname) || !checkValue($meets_at) || !checkValue($room)){
									die("Invalid query parameters. \n" . "Missing parameters" . 
										(!checkValue($cid) ? "'cid'\n" : "") .
										(!checkValue($cname) ? "'cname'\n" : "") .
										(!checkValue($meets_at) ? "'meets_at'\n" : "") .
										(!checkValue($room) ? "'room'\n" : "")
									   );
								}
								$sql = "CALL insert_course('$cname', '$meets_at', '$room')";
							}
								break;
								
							case "DELETE": {
								if(!checkValue($cid)){
									die("Invalid query parameters. \n" . "Missing parameters" . 
										(!checkValue($cid) ? "'cid'\n" : "")
									   );
								}
								$cid = $_POST['cid'];

								$sql = "DELETE FROM Course 
									WHERE cid=".$cid;
							}
								break;
								
							case "UPDATE": {
								$cid = $_POST['cid'];
								$cname = $_POST['cname'];
								$meets_at = $_POST['meets_at'];
								$room = $_POST['room'];

								$sql = "UPDATE Course
									SET 
									( 
										cname='".$cname."', 
										meets_at='".$meets_at."', 
										room='".$room."'
									) 
									WHERE
										cid=".$cid;
							}
								break;
						}
					}
					break;
					
				case "Student": { // Table = Student
						switch($adminQ){
							case "INSERT":
								break;
							case "DELETE":
								break;
							case "UPDATE":
								break;
						}
					}
					break;
					
				case "Enrolled": {// Table = Enrolled
						switch($adminQ){
							case "INSERT":
								break;
							case "DELETE":
								break;
							case "UPDATE":
								break;
						}
					}
					break;
					
				case "Faculty": { // Table = Faculty
						switch($adminQ){
							case "INSERT":
								break;
							case "DELETE":
								break;
							case "UPDATE":
								break;
						}
					}
					break;
					
				case "Offered": {// Table = Enrolled
						switch($adminQ){
							case "INSERT":
								break;
							case "DELETE":
								break;
							case "UPDATE":
								break;
						}
					}
					break;
					
			}
		
			if(!empty($sql)){ // check if a query was found
				$mysqli->query($sql);
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
			
		<div class="container"> 
			<form id="form1" method="POST">
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
		</div>
			
		<script>
			queryInput();
		</script>
	</body>
</html>