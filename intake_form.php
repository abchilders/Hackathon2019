<?php
	
// ends and restarts the session from the landing page 
function intake_form()
{
	?>
	<p> Complete intake form! </p>
	
	<p> <a href="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
        Start Over </a> </p>
	<?php
}
	
?>