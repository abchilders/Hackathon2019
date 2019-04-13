<?php
	
// ends and restarts the session from the landing page 
function restart()
{
	// end session
	session_destroy(); 
	
	// restart a new session from the landing page 
	//session_regenerate_id(TRUE); 
	//session_start(); 
	
	//create_form(); 
	//$_SESSION["next-step"] = "contact-reason"; 
}
	
?>