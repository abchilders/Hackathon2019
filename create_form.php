<?php
// CURRENTLY A STUB FOR DEBUGGING PURPOSES. 

/* Creates an initial form asking for caller and youth data from the user. 
*/

function create_form()
{
	?>
	<p> Landing page. </p> 
	<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
		method="post">
	<?php
		prompt_for_age(); 
	?>
		<input type="submit" name="submit" />
	</form>
	<?php
}
?>