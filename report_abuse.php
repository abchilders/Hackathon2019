<?php
// Creates a form to record caller information regarding reported abuse/neglect.

function report_abuse()
{
	?>
	<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
	  method="post">
		<label for="notes"> Take detailed notes. You may be asked to make a report at 
		a later date. </label> <br />
		
		<textarea id="notes" name="notes" rows="20" cols="75"> </textarea> <br/>
	<input type="submit" name="abuse_report" value="Finish" />
	</form>
	<?php
}
?>