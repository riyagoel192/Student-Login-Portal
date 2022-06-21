<?php

	if(isset($_POST['feed_submit']))
	{
		include('db_conn.php');
		$name = $_POST["feed_name"];
		$email = $_POST["feed_email"];
		$branch = $_POST["menu"];
		$subject = $_POST["feed_subject"];
		$message = $_POST["feed_msg"];

		$sql = "INSERT INTO feedback VALUES('$name','$email', '$branch', '$subject', '$message')";

		if(mysqli_query($conn, $sql))
 		{
 			// echo "Details inserted successfully";
 			$to = "riyagoel192@gmail.com";
 			$headers = "From: riyacskmv@gmail.com";
  			if (mail($to,$subject,$message,$headers))
      			echo "Your Mail is sent successfully.";
  			else
      			echo "Your Mail is not sent. Try Again.";
 			
 			// echo '<script>alert("Feedback submitted and mail sent")</script>';
 			// echo "<script> window.location.href = 'welcome.php'</script>";
 		}
 	
 		else
 		{
 	   		// echo "values not inserted successfully";
       		$error =mysqli_error($conn);
       		echo $error;
 		}
	}

?>

