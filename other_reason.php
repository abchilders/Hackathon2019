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
		<label> State why the caller was calling and what information you gave them. <br/>
			<textarea name="other_call_reason" rows="20" cols="50"> </textarea>
		</label>
		</fieldset>
		<input type="submit" name="other_reason" value="finish" />
	</form>
	<?php
}
?>