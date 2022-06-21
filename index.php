<?php

if(isset($_POST["submit"]))
{
	include('db_conn.php');
	// echo "<script> window.location.href = 'https://github.com/riyagoel192/webD_project_SemIV';</script>";
	$email = $_POST["email"];
 	$password= $_POST["password"];

 	$sql = "SELECT password FROM student WHERE email='$email'";
 	$result = mysqli_query($conn, $sql);

 	if(mysqli_num_rows($result)>0)
 	{
 		//record already exists. No need to insert value again
 		while($row = mysqli_fetch_array($result))
 		{

 			if($row['password']==$password)
 			{
 				$url="welcome.php?id=".$email."";
 				echo "<script> window.location.href = '$url'</script>";
 			}
 			else
 			{
 				// echo "<script>document.getElementById('error_log').innerHTML = 'Password mismatch';</script>";
 				echo "<script>alert('Password mismatch');</script>";
 			}
            
        }
 		
 	}

 	else
 	{
 		$sql = "INSERT INTO student VALUES('$email','$password')";

 		if(mysqli_query($conn, $sql))
 		{
 			// echo "Details inserted successfully";
 			$user_name = strstr($email, '@', true);
 			$url="welcome.php?id=".$email."";
 			echo "<script> window.location.href = '$url'</script>";
 		}
 	
 		else
 		{
 	   		// echo "values not inserted successfully";
       		$error =mysqli_error($conn);
       		echo $error;
 		}
 	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Student Portal</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

	<div id="section1">
	
	<span id="jnu_logo">
		<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/JNU_logo.svg/1200px-JNU_logo.svg.png" id="logo">
	</span>

	<span id="heading">
		Jawaharlal Nehru University<br>
		<div id="subhead">Grade "A" Accredited by NAAC</div>
	</span><br>

	</div>
	
	<div id="segment1">
		
		<p><b>Jawaharlal Nehru University (JNU)</b></p>

		<p id="info">Ever since its inception in 1974, this School has been trying to meet the computing needs of different Schools in JNU and offering specially designed courses for their students.<br><br>

		The courses in the School are well organized to provide a wide spectrum of choices to the students.The faculty and the students interests include a wide area of Computer's Database Systems, Artificial Intelligence,Computer Networks & Distributed Computing, Numerical Analysis, Computer Graphics, Mathematical Modeling, Statistical Methods, Optimization Techniques (Operational Research), OOPS, Advanced DBMS (OODBMS, Distributed DBMS etc.), Software Engineering, MEMS, RF MEMS, BioMEMS, Non-Silicon Microsystems Technologies, VLSI and Embedded Systems etc.</p>

		<p><b>Courses Offered</b></p>

		<table style="width: 105%;">
			
			<tr class="rows">
				<th class="headers_c">Masters of Computer Applications (MCA)</th>
			</tr>

			<tr class="rows">
				<th class="headers_c">M.Tech</th>
			</tr>

			<tr class="rows">
				<th class="headers_c">PhD</th>
			</tr>
			
		</table>

	</div>

	<div id="segment2">
		

		<form action="index.php" id="myform" method="POST">
			<i class="fa fa-user-circle fa-4x" aria-hidden="true"></i>
			<br>
			<h6>Login</h6>
			<label class="labels">Email ID</label>
			<input type="text" name="email" id="email" required/>
			<label class="labels">Password</label>
			<input type="password" name="password" id="password" required/>
			<br>
			<!-- <span id="error_log" style="margin-left: 5px;color:red;">hi</span><br> -->
			<input type="checkbox" id="remember" name="rem" value="remember">
			<label id="rem_me">Remember me?</label><br>
			<input type="submit" name="submit" value="Sign In" id="submit">

		</form>

	</div>

	<script src="script.js"></script>

</body>
</html>