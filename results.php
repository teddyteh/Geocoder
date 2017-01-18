<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

	<?php

		echo "Did you mean?</br>";
		// Show results 
		$results = $_SESSION['data'];

		foreach ($results as $result) {
			echo '<a href="result.php?address=' . $result . '">' . $result . '</a></br>';
		}

		session_destroy();
	?>

</body>
</html>