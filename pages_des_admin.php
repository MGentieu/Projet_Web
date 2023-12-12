<?php  
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pages des admins</title>
</head>
<body>
	<div id="wrapper">
		<p>
			<center>
				<?php 
				echo "Bonjour ".$_SESSION['prenom_admin']." ".$_SESSION['nom_admin']."<br>";
				?>
			</center>
		</p>
	</div>
</body>
</html>