<?php
	
// ends and restarts the session from the landing page 
function restart()
{
	// end session
	session_destroy(); 
	
	// restart a new session from the landing page 
	session_regenerate_id(TRUE); 
	session_start(); 
	
	// IF THIS DOESN'T WORK, INCLUDE A CALL TO THE FUNCTION THAT CREATES THE 
	// LANDING PAGE 
}
	
?>