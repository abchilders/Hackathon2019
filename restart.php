<?php
	
// ends and restarts the session from the landing page 
function restart()
{
	// end session
	session_destroy(); 
	
	// restart a new session from the landing page 
	session_start(); 
	
	create_login(); 
	$_SESSION["next-step"] = "start-form"; 
}
	
?>