<?php
	
// ends and restarts the session from the landing page 
function restart()
{
	// end session
	session_destroy(); 
	
	// restart a new session from the landing page 
	//session_regenerate_id(TRUE); 
	// TRY THIS WHEN WE GET BACK
	session_start(); 
	
	create_form(); 
	$_SESSION["next-step"] = "contact-reason"; 
}
	
?>