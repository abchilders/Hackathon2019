<?php
	session_start(); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
	Template courtesy of Sharon Tuttle
    by: Rawan Almakhloog, Alex Childers, Daysi Hilario, Sthephany Ponce
    last modified: 2019/04/12

    you can run this using the URL: 
	https://nrs-projects.humboldt.edu/~abc66/Hackathon2019/inquiry-handling.php

-->

<head>
    <title> Call Response </title>
    <meta charset="utf-8" />
	
	<?php
		require_once("create_form.php"); 
		require_once("reason_contact.php"); 
		require_once("reason_response.php"); 
		require_once("general_info.php");
		require_once("report_abuse.php");
		require_once("non_shelter.php");
		require_once("shelter.php");
		require_once("prompt_for_age.php"); 
		
	?>

    <link href="normalize.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<?php
	// create the initial form
	if (! array_key_exists("next-step", $_SESSION))
	{
		create_form(); 
		$_SESSION["next-step"] = "contact-reason"; 
	}
	
	elseif($_SESSION["next-step"] == "contact-reason")
	{
		// add age to session array
		if( (array_key_exists ("age", $_POST)) and 
			($_POST["age"] != "") )
		{
			$_SESSION["age"] = htmlspecialchars($_POST["age"]); 
		}
		reason_contact();  
		$_SESSION["next-step"] = "reason-response"; 
	}
	
	elseif($_SESSION["next-step"] == "reason-response")
	{
		if (array_key_exists("reason", $_POST))
		{
			$_SESSION["reason"] = htmlspecialchars($_POST["reason"]);
		}
		
		// respond depending on the reason for calling
		
		// IDEA: put checkboxes that are on into an array and iterate through the array to make sure we 
		// respond to all checkboxes (TO DO LATER)
		// TO DO: add "other" option 
		if($_SESSION["reason"] == "general_info" )
		{
			general_info();
			$_SESSION["next-step"] = "end_session"; 
		}
		
		elseif($_SESSION["reason"] == "report_abuse" )
		{
			report_abuse();
			$_SESSION["next-step"] = "end_session"; 
		}
		
		elseif($_SESSION["reason"] == "non_shelter" )
		{
			non_shelter();
			$_SESSION["next-step"] = "end_session"; 
		}
		
		elseif($_SESSION["reason"] == "shelter" )
		{
			// verify that age has been input 
			if (! array_key_exists("age", $_SESSION))
			{
				prompt_for_age(); 
			}
			else
			{
				
			}
		}
	}

	?>
<!-- remove footer when presenting -->
    <hr />

    <p>
        Validate by pasting .xhtml copy's URL into<br />
        <a href="https://html5.validator.nu/">
            https://html5.validator.nu/
        </a>
    </p>

    <p>
        <a href=
           "http://jigsaw.w3.org/css-validator/check/referer?profile=css3">
            <img src="http://jigsaw.w3.org/css-validator/images/vcss"
                 alt="Valid CSS3!" height="31" width="88" />
        </a>
    </p>

</body>
</html>

