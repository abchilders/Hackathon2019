<?php
	
// ends and restarts the session from the landing page 
function restart()
{
	// end session
	session_destroy(); 
	
	// restart a new session from the landing page 
	session_start(); 
	
	require_once("Startingpoint.html"); 
	$_SESSION["next-step"] = "contact-reason"; 
}
	
?>