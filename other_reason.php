<?php
// Allows user to input what occurred if caller's reason for calling was 
// "other."

function other_reason()
{
	?>
	<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
          method="post">
		<fieldset>
		<legend> Other reason</legend>
		<label> State why the caller was calling and what information you gave them.
			<textarea rows="5" cols="20"> </textarea>
		</label>
		</fieldset>
	</form>
	<?php
}
?>