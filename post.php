<?php 
session_start(); 
if(isset($_SESSION['ep'])){ 
	//$nom_log="\log.html";
	date_default_timezone_set('Europe/Paris');
	$text = $_POST['text']; 
	$text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['ep']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>"; 
	// file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX); 
	$filepath=$_SESSION['filepath'];
	$myfile = fopen($filepath, "a") or die("Impossible d'ouvrir le fichier " . $filepath); 
	fwrite($myfile, $text_message); 
	fclose($myfile); 
} 
?>