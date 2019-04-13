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
		require_once("referrals.php");
		require_once("shelter.php");
		require_once("prompt_for_age.php"); 
		require_once("restart.php"); 
		require_once("intake_form.php"); 
	?>

    <link href="normalize.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<?php
	//DEBUG
	if (array_key_exists("next-step", $_SESSION))
	{
		?>
		<p> Next step is: <?= $_SESSION["next-step"] ?> </p>
		<?php
	}
	
	//DEBUG
	if (array_key_exists("reason", $_SESSION))
	{
		?>
		<p> Reason is: <?= $_SESSION["reason"] ?> </p>
		<?php
	}
	
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
		if(! array_key_exists("reason", $_SESSION))
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
		
		elseif($_SESSION["reason"] == "referrals" )
		{
			referrals();
			$_SESSION["next-step"] = "end_session"; 
		}
		
		elseif($_SESSION["reason"] == "shelter" )
		{
			// verify that age has been input 
			if (! array_key_exists("age", $_SESSION) or $_SESSION["age"] == "" )
			{
				if(array_key_exists("age", $_POST))
				{
					$_SESSION["age"] = htmlspecialchars($_POST["age"]); 
				}
				else
				{
					?>
					<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
						method="post">
					<?php
						prompt_for_age(); 
					?>
						<input type="submit" name="submit" />
					</form>
					<?php
				}
			}
			else
			{
				?>
				<p> Entered else branch </p>
				<?php
				// if we're coming from the previous branch (age isn't in the 
				// session array yet), add it before proceeding 
				// add age to session array
				//if(array_key_exists ("age", $_POST))
				//{
					$_SESSION["age"] = htmlspecialchars($_POST["age"]); 
				//}
				
				?>
				<p> $_POST["age"] is <?= htmlspecialchars($_POST["age"]) ?> </p>
				<p> $_SESSION["age"] is <?= $_SESSION["age"] ?> </p>
				<?php
				
				// now, assuming $_SESSION["age"] has been sanitized, redirect
				// to page based on youth's age
				$age = $_SESSION["age"]; 
				
				if (($age >= 12) and ($age <= 17))
				{
					// this person qualifies for same-day shelter, so do an intake form
					intake_form();
					$_SESSION["next-step"] = "end_session"; 
				}
				elseif (($age >= 18) and ($age <= 24))
				{
					?>
					<p> We do not provide same-day shelter for this age group, but they
						may qualify for one of our transitional housing programs. </p>
					<?php
					referrals(); 
					$_SESSION["next-step"] = "end_session"; 
				}
				// if the person is less than 12 or older than 24 
				else
				{
					// can't provide services for this person; refer them
					?>
					<p> We do not provide housing for people under 12 or over 24. </p> 
					<?php
					referrals();
					$_SESSION["next-step"] = "end_session"; 
				}
			}
		}
	}
	elseif($_SESSION["next-step"] == "end_session")
	{
		restart(); 
	}
	else
	{
		?>
			<p> AY AY AY </p> 
		<?php
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

