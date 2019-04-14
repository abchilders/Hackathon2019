<?php
	session_start(); 
	
	if(! array_key_exists("title", $_SESSION))
	{
		$_SESSION["title"] = "Starting Point"; 
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
	Template courtesy of Sharon Tuttle
    by: Rawan Almakhloog, Alex Childers, Daysi Hilario, Sthephany Ponce
    last modified: 2019/04/12

    you can run this using the URL: 
	https://nrs-projects.humboldt.edu/~abc66/Hackathon2019/user-interface.php

-->

<head>
    <title> <?= $_SESSION["title"] ?> </title>
    <meta charset="utf-8" />
	
	<?php
		require_once("create_form.php"); 
		require_once("reason_contact.php"); 
		require_once("reason_response.php"); 
		require_once("general_info.php");
		require_once("report_abuse.php");
		//require_once("referrals.php");
		require_once("shelter.php"); 
		require_once("restart.php"); 
		require_once("intake_form.php"); 
	?>

    <link href="normalize.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<?php
	/* DEBUGGING STUFF
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
	
	//DEBUG
	if (array_key_exists("age", $_SESSION))
	{
		?>
		<p> Age is: <?= $_SESSION["age"] ?> </p>
		<?php
	}*/
	
	// create the initial form
	if (! array_key_exists("next-step", $_SESSION))
	{
		require_once("Startingpoint.html"); 
		$_SESSION["next-step"] = "contact-reason"; 
		$_SESSION["title"] = "Section 1"; 
	}
	
	elseif($_SESSION["next-step"] == "contact-reason")
	{
		// add age to session array
		if( (array_key_exists ("age", $_POST)) and 
			($_POST["age"] != "") )
		{
			$_SESSION["age"] = htmlspecialchars($_POST["age"]); 
		}
		
		if( (array_key_exists("caller_name", $_POST)) and 
			($_POST["caller_name"] != "") )
		{
			$_SESSION["caller_name"] = htmlspecialchars($_POST["caller_name"]); 
		}
		
		if( (array_key_exists("caller", $_POST)) and 
			($_POST["caller"] != "") )
		{
			$_SESSION["caller"] = htmlspecialchars($_POST["caller"]); 
		}
		require_once("Section1.html");  
		$_SESSION["next-step"] = "reason-response"; 
		
		//CREATE TITLES IN RESPONSE TO REASON LATER LOL 
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
		if($_SESSION["reason"] == "information" )
		{
			general_info();
			$_SESSION["next-step"] = "end_session"; 
		}
		
		elseif($_SESSION["reason"] == "child" )
		{
			report_abuse();
			$_SESSION["next-step"] = "end_session"; 
		}
		
		elseif($_SESSION["reason"] == "resources" )
		{
			require_once("Section2.html"); 
			$_SESSION["next-step"] = "end_session"; 
		}
		
		elseif($_SESSION["reason"] == "shelter" )
		{
			// if we haven't received age yet at all 
			if (! array_key_exists("age", $_SESSION) and ! array_key_exists("age", $_POST))
			{
				// ask for it
				require_once("require_age.html"); 
			}
				
			// if we get here, age is either in $_SESSION or $_POST, from the above if branch 
			else
			{
				?>
				<p> Entered else branch </p>
				<?php
				// if we're coming from the previous branch (age isn't in the 
				// session array yet), add age to session array
				if(array_key_exists ("age", $_POST))
				{
					$_SESSION["age"] = htmlspecialchars($_POST["age"]); 
				}
				
				// DEBUG
				//<p> $_POST["age"] is <?= htmlspecialchars($_POST["age"]) </p>
				//<p> $_SESSION["age"] is <?= $_SESSION["age"] </p>
				
				// now, assuming $_SESSION["age"] has been sanitized, redirect
				// to page based on youth's age
				$age = $_SESSION["age"]; 
				
				if ($age == "12-17") 
				{
					// this person qualifies for same-day shelter, so do an intake form
					//intake_form();
					?>
					<h1> Complete the following shelter intake checklist. </h1>
					<?php
					require_once("Intakeform.html");
					$_SESSION["next-step"] = "end_session"; 
				}
				elseif ($age == "18-24")
				{
					?>
					<ul>
						<li>Inform them that we do not have same-day shelter for this group, but that they may 
				qualify for one of our transitional housing programs. </li>
						<li> Make sure you have reliable contact information 
						and tell them someone will be calling them back in the 
						next few days with more detail about these programs.</li>
						<li> Provide referrals as needed (document any referrals in SECTION 2)</li>
					</ul>
					
					<?php
					require_once("Section2.html");
					$_SESSION["next-step"] = "end_session"; 
				}
				// if the person is less than 12 or older than 24 
				elseif (($age == "11_or_younger") or ($age == "25_or_older"))
				{
					// can't provide services for this person; refer them
					?>
					<p> We do not provide housing for people under 12 or over 24. </p> 
					<?php
					require_once("Section2.html"); 
					$_SESSION["next-step"] = "end_session"; 
				}
				else
				{
					// if we don't know your age, we can't help you
					?>
					<p> We can't help you if we don't know your age, but there
						are other resources we can refer you to. </p>
					<?php
					require_once("Section2.html"); 
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
	
	//DEBUG
	if (array_key_exists("age", $_SESSION))
	{
		?>
		<p> Age is: <?= $_SESSION["age"] ?> </p>
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

