<!DOCTYPE html>
<html>
<head>
	<title>upload</title>
</head>
<body>
	<?php
		// echo date('D-M-Y');
		echo mktime(12,05,2019);

	 ?>

	<form enctype="multipart/form-data" action="libs/media.php" method="post">
		<input type="file" name="userfile" />
		<br/>
		<input type="text" name="auteur" placeholder="auteur" />
		<input type="submit" value="Telecharger">
	</form>
</body>
</html>