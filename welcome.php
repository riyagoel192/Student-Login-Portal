<?php

// $email = $_GET['id'];
$email = isset($_GET['id']) ? $_GET['id'] : '';

?>

<?php

include("db_conn.php");

if(isset($_POST["submit"]))
{
		$new_p = $_POST["new_p"];
		$confirm_p = $_POST["cnew_p"];
		$old_p = $_POST["old_p"];
		$store_mail = $_GET['id'];

		$sql = "SELECT * FROM student WHERE email='$store_mail' AND password='$old_p'";
		$result = mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)>0)
		{
				if($new_p === $confirm_p)
				{
						$sql = "UPDATE student SET password='$new_p' WHERE email='$store_mail'";
						if(mysqli_query($conn, $sql))
						{
								echo '<script>alert("Records were updated successfully")</script>';
								// echo "<span style='color:red;margin-top:30%;margin-left:50%;position:absolute;'>Records were updated successfully</span>";
						}
						else
						{
								echo '<script>alert("problem in query")</script>';
							// echo "<span style='color:red;margin-top:30%;margin-left:50%;position:absolute;'>Problem in query</span>";
						}
				}

				else
				{
						echo '<script>alert("Passwords dont match")</script>';
						// echo "<span style='color:red;margin-top:30%;margin-left:50%;position:absolute;'>Passwords don't match</span>";
						// echo "<script> window.location.href = 'welcome.php'</script>";
				}
		}

		else
		{
				echo '<script>alert("No matching record for the user has been found")</script>';
				// echo "<span style='color:red;margin-top:30%;margin-left:50%;position:absolute;'>No matching record for the user has been found</span>";
		}
}

?>


<?php
$table_counter = 1;
include("db_conn.php");
if(isset($_POST["go"]))
{
		// echo "Output a table";
		// $mail_id = $_GET['id'];
		$acadsession = $_POST["acadsession"];
		$sess_year = $_POST["sess_year"];
		$sql = "SELECT * FROM ia WHERE Email='$email' AND Year='$sess_year' AND Session='$acadsession'";
		$result = mysqli_query($conn,$sql);


		if (mysqli_num_rows($result) > 0) {
  				
			echo "<table id='ia_table' rules='all'>";
			echo "<th class='headers'>SNo.</th>";
			echo "<th class='headers'>Subject Name</th>";
			echo "<th class='headers'>Marks out of 25</th>";
  		while($row = mysqli_fetch_assoc($result)) 
  		{
    			// echo $row["Email"]. "  ";
  				echo "<tr><td class='data'>".$table_counter."</td><td class='data'>".$row["SubName"]."</td><td class='data'>".$row["Marks"]."</td></tr>";
    			$table_counter++;
  		}
		} 
			
		else 
		{
  			alert("No records found!!");
		}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body id="wbg">

<div class="sidebar">
  <a class="active" href="#" onclick="toggle('profile');"><i class="fa fa-user"></i>Profile</a>
  <a href="#"onclick="toggle('fee');"><i class="fa fa-credit-card"></i>Fee</a>
  <a href="#" onclick="toggle('attendance');"><i class="fa fa-check-square"></i>Attendance</a>
  <a href="#" onclick="toggle('feedback');"><i class="fa fa-comments" id="btn"></i>Feedback<!-- <i class="fa fa-caret-down"></i> --></a>
  <a href="#" onclick="toggle('ia');"><i class="fa fa-file-text"></i>Internal Assessment</a>
  <a href="#" onclick="toggle('mentor');"><i class="fa fa-handshake"></i>Mentorship</a>
  <a href="#" onclick="toggle('resetp');"><i class="fa fa-database"></i>Reset Password</a>
  <a href="index.php"><i class="fa fa-sign-out"></i>Logout</a>
</div>

<h2 id="w">Welcome <?php 
// $email = $_GET['id'];
$user_name = strstr($email, '@', true);

echo $user_name; ?>

</h2>

<div class="division" id="profile">
	<!-- <p style="margin-top:100px;position:absolute;margin-left: 20%;">Inside profile section</p> -->
	<div id="profile_sec" style="border: 1px solid red;margin: 70px 40px;background-color: lightyellow;padding: 12px;">
	<?php

		$sql = "SELECT * FROM student_data WHERE email= '".$email."'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
  				// output data of each row
  		while($row = mysqli_fetch_assoc($result)) 
  		{
    			echo "<b>Name:  </b>" . $row["name"]. "<br><br><br>";
    			echo "<b>Email:  </b>" . $row["email"]. "<br><br><br>";
    			echo "<b>Address:  </b>" . $row["address"]. "<br><br><br>";
    			echo "<b>Contact:  </b>" . $row["contact"]. "<br>";
  		}
		} 
			
		else 
		{
  			echo "Profile doesn't exist";
		}

	?>
	</div>

</div>

<div class="division" id="fee">
		<table cellspacing="100">

			<tr>
				<th>SNo.</th>
				<th>Calendar Year</th>
				<th>Amount</th>
				<th>Status</th>
				<th>Print Receipt</th>
			</tr>

			<tr>
				<td>1.</td>
				<td>2021-2022</td>
				<td>Rs. 220</td>
				<td>Paid</td>
				<td><a href="slip1.pdf" download>Download</a></td>
			</tr>

			<tr>
				<td>2.</td>
				<td>2020-2021</td>
				<td>Rs. 180</td>
				<td>Paid</td>
				<td><a href="slip2.pdf" download>Download</a></td>
			</tr>


		</table>
</div>

<div class="division" id="attendance">
	<label id="a_year">Year</label>
	<select name="attendance_year" id="attendance_year">
  <option value="2022">2022</option>
  <option value="2021">2021</option>
  <option value="2020">2020</option>
  <option value="2019">2019</option>
</select>

<label id="a_session">Session</label>
	<select name="attendance_session" id="attendance_session">
  <option value="july_dec">July-Dec</option>
  <option value="jan_june">Jan-June</option>
  <option value="june_dec">June-Dec</option>
</select>

<label id="a_fdate">From Date</label>
		<input type="date" id="from_date" name="from_date">

<label id="a_tdate">To Date</label>
		<input type="date" id="to_date" name="to_date">

<label id="a_semester">Semester</label>
	<select name="attendance_sem" id="attendance_sem">
	<option value="6">6</option>
	<option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
</select>

<input type="submit" id="go" name="go" value="GO">

<br><br>

	<table id="attendance_table">

		<tr class="a_tr">
    <th class="a_th">Sno.</th>
    <th class="a_th">Subject Name</th>
    <th class="a_th">Theory (Present)</th>
    <th class="a_th">Theory (Absent)</th>
    <th class="a_th">Practical (Present)</th>
    <th class="a_th">Practical (Absent)</th>
    <th class="a_th">Total Class</th>
    <th class="a_th">Total Present</th>
    <th class="a_th">Total %</th>
  </tr>
  <tr class="a_tr">
    <td class="a_td">1.</td>
    <td class="a_td">Computer Vision</td>
    <td class="a_td">6</td>
    <td class="a_td">4</td>
    <td class="a_td">0</td>
    <td class="a_td">0</td>
    <td class="a_td">10</td>
    <td class="a_td">6</td>
    <td class="a_td">60</td>
  </tr>
  <tr class="a_tr">
    <td class="a_td">2.</td>
    <td class="a_td">Machine Learning</td>
    <td class="a_td">6</td>
    <td class="a_td">4</td>
    <td class="a_td">0</td>
    <td class="a_td">0</td>
    <td class="a_td">10</td>
    <td class="a_td">6</td>
    <td class="a_td">60</td>
  </tr>
  <tr class="a_tr">
    <td class="a_td">3.</td>
    <td class="a_td">Big Data Management</td>
    <td class="a_td">6</td>
    <td class="a_td">4</td>
    <td class="a_td">0</td>
    <td class="a_td">0</td>
    <td class="a_td">10</td>
    <td class="a_td">6</td>
    <td class="a_td">60</td>
  </tr>
  <tr class="a_tr">
    <td class="a_td">4.</td>
    <td class="a_td">Parallel and Distributed Systems</td>
    <td class="a_td">6</td>
    <td class="a_td">4</td>
    <td class="a_td">0</td>
    <td class="a_td">0</td>
    <td class="a_td">10</td>
    <td class="a_td">6</td>
    <td class="a_td">60</td>
  </tr>
  <tr class="a_tr">
    <td class="a_td">5.</td>
    <td class="a_td">Compiler Design</td>
    <td class="a_td">6</td>
    <td class="a_td">4</td>
    <td class="a_td">0</td>
    <td class="a_td">0</td>
    <td class="a_td">10</td>
    <td class="a_td">6</td>
    <td class="a_td">60</td>
  </tr>

	</table>

</div>

<div class="division" id="feedback" style="background-image: url('https://media.istockphoto.com/vectors/pastel-color-background-vector-id1124919565?k=20&m=1124919565&s=170667a&w=0&h=xIcjVLNPKmfw8VBWJxDfFB_U21BSf78oVsrV-Jc9sWM=');background-repeat: no-repeat;background-size: cover;">
	<!-- <p style="margin-top:100px;position:absolute;margin-left: 20%;">Inside feedback section</p> -->
	
	<div id="feedback_form" style="width:80%;height: 90%;margin-top:5%;margin-left: 10%;text-align: center;">

		<form id="feed_form" action="feedback.php" method="POST">
			
			<label class="labels_feedback">Name: </label><br>
			<?php

				include("db_conn.php");

				$sql = "SELECT * FROM student_data WHERE email='$email'";
				$result = mysqli_query($conn,$sql);

				if(mysqli_num_rows($result)>0)
				{
						while($row = mysqli_fetch_assoc($result)) 
  					{
    						$fname = $row["name"];
    						$mail = $row["email"];
  					}
				}

				else
				{
						$fname="";
						$mail = "";
				}

			?>
			<input type="text" name="feed_name" class="fields" value=<?php echo $fname; ?> readonly required>

			<br><br>

			<label class="labels_feedback">Email: </label><br>
			<input type="text" name="feed_email" class="fields" value=<?php echo $mail; ?> readonly required>

			<br><br>

			<label class="labels_feedback">Branch: </label><br>
			<!-- <input type="dropdown" name="feed_branch" placeholder="Enter branch" style="margin: 3% 0%;"> -->
			<select name="menu" id="branch" class="fields">
    		<option value="library">Library</option>
    		<option value="hostel">Hostel</option>
    		<option value="canteen">Canteen</option>
    		<option value="academics">Academics</option>
  		</select>

			<br><br>

			<label class="labels_feedback">Subject: </label><br>
			<input type="text" name="feed_subject" placeholder="Enter subject" class="fields" required>

			<br><br>

			<label class="labels_feedback" id="feedback_message">Message: </label><br>
			<textarea class="fields" id="textarea_feedback" name="feed_msg" rows="4" cols="50" required></textarea>

			<br><br>

			<input type="submit" id="feed_submit" name="feed_submit" value="Submit Details">
		</form>
	</div>

</div>

<div class="division" id="ia" style="text-align: center;">
	<p style="margin-top:80px;position:absolute;margin-left: 10%;border:1px solid blue;background-color: lightblue;width:80%;padding: 15px;font-weight:bold;font-size:20px;">Internal Assessment Marks</p><br><br>

	<div style="text-align:left;margin-top: 10%;padding: 10px;">

		<form method="POST">

			<label for="session" style="margin-left: 15%;font-size: 18px;">Session:</label>
				
				<select id="acadsession" name="acadsession" style="margin-left: 10%;font-size: 14px;">
  					<option value="jantojune">Jan-June</option>
  					<option value="julytodec">July-Dec</option>
					</select>

			<label for="year" style="margin-left: 20%;font-size: 18px;">Year:</label>
				
				<select id="sess_year" name="sess_year" style="margin-left: 10%;font-size: 14px;">
  					<option value="2022">2022</option>
  					<option value="2021">2021</option>
  					<option value="2020">2020</option>
  					<option value="2019">2019</option>
				</select>

			<input type="submit" name="go" value="Go" id="go">

		</form>

		<!-- <button id="go">Go</button> -->

		<table id="ia_table" rules="all">

			<th class="headers">SNO.</th>
			<th class="headers">SUBJECT NAME</th>
			<th class="headers">MARKS OUT OF 25</th>

			<tr class="ia_table_row">
				<td class="ia_td">1.</td>
				<td>Computer Vision</td>
				<td>20</td>
			</tr>

			<tr class="ia_table_row">
				<td class="ia_td">2.</td>
				<td>Machine Learning</td>
				<td>17</td>
			</tr>

			<tr class="ia_table_row">
				<td class="ia_td">3.</td>
				<td>Parallel and Distributed Systems</td>
				<td>20</td>
			</tr>


			<tr class="ia_table_row">
				<td class="ia_td">4.</td>
				<td>Big Data management</td>
				<td>23</td>
			</tr>

			<tr class="ia_table_row">
				<td class="ia_td">5.</td>
				<td>Compiler Design</td>
				<td>21</td>
			</tr>

		</table>

	</div>
</div>

<div class="division" id="mentor">
	<div id="show_mentor">
		<br><br>
		<!-- <h2><center>Mentor Details</center></h2> -->
		<?php

			$sql = "SELECT * FROM mentor_details WHERE email= '".$email."'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
  				// output data of each row
  				while($row = mysqli_fetch_assoc($result)) 
  				{
    				echo "Name: " . $row["name"]. "<br><br><br>";
    				echo "Your mentor is: " . $row["mentor_name"]. "<br><br><br>";
    				echo "Email address: ". $row["mentor_email"]. "<br>";
  				}
			} 
			
			else 
			{
  				echo "No mentor assigned";
			}

		?>

	</div>
</div>

<div class="division" id="resetp">
	<h2 id="helpdesk"><center><span>JNU User Help desk Service</span></center></h2>
	<form id="reset_form" action="welcome.php?id=<?php echo $email; ?>" method="POST">
		<label class="label_r">Enter Old Password:</label><br>
		<input class="boxr" type="password" name="old_p" required><br>
		<label class="label_r">Enter New Password:</label><br>
		<input class="boxr" type="password" name="new_p" required><br>
		<label class="label_r">Confirm New Password:</label><br>
		<input class="boxr" type="password" name="cnew_p" required><br><br>
		<input type="submit" name="submit" value="Reset" id="reset">

	</form>
</div>
<!-- 
<div class="division" id="logout" style="border:1px solid red;height:92%;background-color: lightgreen;display:none;position: absolute;margin-left: 16.5%;width:83.2%;">
	<p style="margin-top:100px;position:absolute;margin-left: 20%;">Inside logout section</p>
</div> -->



<script src="script.js"></script>
</body>
</html>
