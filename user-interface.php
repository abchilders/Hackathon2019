<?php

	session_start(); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
	Template courtesy of Sharon Tuttle
    by: Rawan Almakhloog, Alex Childers, Daysi Hilario, Sthephany Ponce
    last modified: 2019/04/14

    you can run this using the URL: 
	https://nrs-projects.humboldt.edu/~abc66/Hackathon2019/user-interface.php
-->

<head>
    <title> Inquiry Response </title>
    <meta chars t="utf-8" />
	
	<link href="normalize.css" type="text/css" rel="stylesheet" /> 
	<link href="starting_point.css" type="text/css" rel="stylesheet"/> 
	<!--
	<style>
	body
		{
			margin-left: 1em;
			background-color: beige;
		}

	form
		{
			margin-left: auto;
			margin-right: auto;
			width: 50%;
		}


	fieldset
		{
			background-color: #ffffcc;
			padding: 1em; 
		}
	legend
		{
  			background-color: white; 
  			list-style-type: none;
  			text-align: center; 
  			padding: 0;
  			margin: 0;
  			border: 0.1em solid black;  
		}
	</style> -->
	<?php
		require_once("create_form.php"); 
		require_once("reason_contact.php"); 
		require_once("reason_response.php"); 
		require_once("general_info.php");
		require_once("report_abuse.php");
		require_once("shelter.php"); 
		require_once("restart.php"); 
		require_once("intake_form.php");
		require_once("other_reason.php"); 
		require_once("add_to_session.php"); 
	?>
	
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
	}
	
	elseif($_SESSION["next-step"] == "contact-reason")
	{
		add_to_session("date"); 
		add_to_session("staff"); 
		add_to_session("caller_name"); 
		add_to_session("youth"); 
		add_to_session("parent"); 
		add_to_session("cws"); 
		add_to_session("other_one");
		add_to_session("youth_name");
		add_to_session("dob"); 
		add_to_session("age"); 
		add_to_session("caller"); 
		add_to_session("youth"); 
		add_to_session("gardian");
		add_to_session("get_caller_reason"); 
		
		require_once("Section1.html");  
		$_SESSION["next-step"] = "reason-response"; 
	}
	
	elseif($_SESSION["next-step"] == "reason-response")
	{
		add_to_session("reason"); 
		add_to_session("respond_to_reason"); 
		
		// respond depending on the reason for calling
		
		// IDEA: put checkboxes that are on into an array and iterate through the array to make sure we 
		// respond to all checkboxes, sometime in the future
		
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
			?>
			<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
				method="post">
				<?php
				require_once("Section2.html");
				?>
			</form>
			<?php
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
				// if we're coming from the previous branch (age isn't in the 
				// session array yet), add age to session array
				add_to_session("age"); 
				
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
					
					<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
					method="post">
					<fieldset>
						<legend> Add caller information as needed. </legend>
						<label>
							Name of caller:
							<input type="text" name="caller_name" 
							<?php
							if(array_key_exists("caller_name", $_SESSION))
							{
								?>
								value="<?= $_SESSION["caller_name"] ?>"
								<?php
							}
							?>
							/> 
						</label><br/>
						<label>
							Caller phone number/contact info:
							<input type="text" name="caller"
							<?php
							if(array_key_exists("caller", $_SESSION))
							{
								?>
								value="<?= $_SESSION["caller"] ?>"
								<?php
							}
							?>
							/>
						</label><br/>
						<label> Other contact information: 
						<textarea name="other_contact" rows="5" cols="20"></textarea>
						</label>
					</fieldset>
					<?php
					require_once("Section2.html");
					?>
					</form>
					<?php
					$_SESSION["next-step"] = "end_session"; 
				}
				// if the person is less than 12 or older than 24 
				elseif (($age == "11_or_younger") or ($age == "25_or_older"))
				{
					// can't provide services for this person; refer them
					?>
					<p> We do not provide housing for people under 12 or over 24. </p> 

					<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
					method="post">
					<?php
					require_once("Section2.html");
					?>
					</form>
					<?php
					$_SESSION["next-step"] = "end_session"; 
				}
				else
				{
					// if we don't know your age, we can't help you
					?>
					<p> We can't help you if we don't know your age, but there
						are other resources we can refer you to. </p>
						
					<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
					method="post">
					<?php
					require_once("Section2.html");
					?>
					</form>
					<?php
					$_SESSION["next-step"] = "end_session"; 
				}
			}
		}
		elseif($_SESSION["reason"] == "other_two" )
		{
			other_reason(); 
			$_SESSION["next-step"] = "end_session"; 
		}
	}
	elseif($_SESSION["next-step"] == "end_session")
	{
		// record final inputs
		
		// for reason: getting general info 
		add_to_session("general_info");
		
		// for reason: report abuse/neglect
		add_to_session("notes");
		add_to_session("abuse_report"); 
		
		// for reason: provide non-shelter referrals 
		add_to_session("caller_name");
		add_to_session("caller");
		add_to_session("other_contact");
		add_to_session("welfare");
		add_to_session("mental_health");
		add_to_session("abuse_services");
		add_to_session("system_agency");
		add_to_session("domestic_violence");
		add_to_session("rape_crisis");
		add_to_session("law_enforcement");
		add_to_session("free_meal");
		add_to_session("a_house");
		add_to_session("r_progcet");
		add_to_session("betty_chinn");
		add_to_session("food_for_people");
		add_to_session("other_three");
		add_to_session("referral");
		
		// for reason: shelter intake 
		add_to_session("ask_needed");
		add_to_session("si_intent");
		add_to_session("fight");
		add_to_session("how_often");
		add_to_session("soc_worker");
		add_to_session("whats_the_name");
		add_to_session("comfort");
		add_to_session("stay");
		add_to_session("not_sheltered");
		add_to_session("shelter_intake");
		
		// for reason: other
		add_to_session("other_call_reason");
		add_to_session("other_reason");
		
		?>
		<p> Your response has been submitted. The information we've gathered, 
			which could now be collected in a database, is: </p> 
		<ul> 
		<?php
		foreach($_SESSION as $key => $value)
		{
			?>
			<li> <?= $key ?>: <?= $value ?> </li> 
			<?php
		}
		?>
		</ul>
		
		<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
          method="post">
		  <input type="submit" name="restart" value="Record new call" /> 
		</form>
		<?php
		
		$_SESSION["next-step"] = "restart"; 
	}
	else if($_SESSION["next-step"] == "restart")
	{
		restart(); 
	}
	else
	{
		?>
			<p> Should not have gotten here?!?! </p> 
		<?php
	}
	
	/*
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

	?>

</body>
</html>

