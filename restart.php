<?php
	
// ends and restarts the session from the landing page 
function restart()
{
	// end session
	session_destroy(); 
	
	// restart a new session from the landing page 
	session_start(); 
	
	<p> Inquiry record successfully submitted. Thank you! </p> 
	create_login(); 
	$_SESSION["next-step"] = "start-form"; 
}
	
?>