<?php
// CURRENTLY A STUB FOR DEBUGGING PURPOSES. 

/* Creates an initial form asking for caller and youth data from the user. 
*/

function report_abuse()
{
	?>
	<p> Incluse a tex are for the report. </p> 
	
	<p> <a href="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
        Start Over </a> </p>
	<?php
}
?>