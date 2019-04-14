<?php
// Gives instructions for the user to give the caller general information
// on YSB. 

function general_info()
{
	?>
	<p> Give the caller general information about <strong>
	<a href="http://rcaa.org/youth-service-bureau"
		target="_blank">YSB programs</a></strong>.
	
	<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"
	  method="post">
	  <input type="submit" name="general_info" value="Finish"/>
	</form>
	<?php
}
?>