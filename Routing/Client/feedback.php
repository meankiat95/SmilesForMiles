<?php
	$feedback = htmlspecialchars($_POST["feedback"]);
   	if( $feedback) {
   		$feedback = $_POST["feedback"];
   		if (strlen($feedback) > 5) {
			echo $feedback;
   		}
      		echo "<script>window.close();</script>";
      
      exit();
   }
?>