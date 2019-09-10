<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Formularz wpisu</title>		
		<script src="walidacjaFormularzy.js" type="text/javascript"></script>
		<script src="files.js" type="text/javascript"></script>
	</head>
	<body onload="pobierzAktualnaDate(); sprawdzCzyDobraData() ">
		<h1>Formularz wpisu</h1>
		<?php include 'menu.php';  ?> 
	<form action="wpis.php" method="post" enctype="multipart/form-data">
		<p>Nazwa Użytkownika: <input type="text" name="nazwaUzytkownika" /></p>
		<p>Hasło: <input type="password" name="hasło" /></p>
		<p>Wpis: <textarea name="wpis" cols="100" rows="10"></textarea></p>
		<p>Data: <input id="data" type="text" name="daty"  value=""  /></p>
		<p>Godzina: <input id="godzina" type="text" name="godzina"  value="" /> </p>
		<div id="files">
			<p><input type="button" name="adding" id="adding" onClick="insertNewFile();" value="+" /></p>
			
		</div>
			
		<?php session_start(); 
		if(isset($_SESSION['badpin']) and $_SESSION['badpin']){
				echo "Zła nazwa użytkownika lub hasło";
				$_SESSION['badpin']= false; } 
		?> 
		
		<p><input id="wyslij" type="submit" value="Wyślij" /></p>
		<input type="reset" value="Wyczyść" />
	</form>
		
	</body>
</html>
