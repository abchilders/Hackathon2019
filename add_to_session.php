<?php
// Adds a given item from the $_POST array to the $_SESSION array. 

function add_to_session($post_input)
{
	if( (array_key_exists ("$post_input", $_POST)) and 
			($_POST["$post_input"] != "") )
		{
			$_SESSION["$post_input"] = htmlspecialchars($_POST["$post_input"]); 
		}
}
?>