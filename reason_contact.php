<?php
// CHANGE METHOD TO POST BEFORE PRESENTING

/* Creates a form asking the user what the reason for contact is. 
	Occurs after the landing page, and moves to the next page depending
	on what the caller needs. 
*/

function reason_contact()
{
	?>
	<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
		method="post">
		<label for="general_info"> General Info </label>
		<input type="radio" name="reason" id="general_info" value="general_info" />
		
		<label for="report_abuse"> Report child abuse/neglect </label>
		<input type="radio" name="reason" id="report_abuse" value="report_abuse" />
		
		<label for="non_shelter"> Request non-shelter resources </label>
		<input type="radio" name="reason" id="non_shelter" value="non_shelter" />
		
		<label for="shelter"> Request shelter </label>
		<input type="radio" name="reason" id="shelter" value="shelter" />
		
		<input type="submit" name="submit" />
	</form>
	<?php
}
?>
