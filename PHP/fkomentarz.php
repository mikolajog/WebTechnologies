<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Formularz komentarza</title>	
		<script src="walidacjaFormularzy.js" type="text/javascript"></script>
	</head>
	<body>
		
		<h1>Formularz komentarza</h1>
		<?php include 'menu.php';   ?> 
	<form action="koment.php" method="post">
		<p>Rodzaj komentarza: <select name="rodzajKomentarza">
			<option>pozytywny</option>
			<option>negatywny</option>
			<option>neutralny</option>
			</select>
		</p>
		
		<?php session_start(); $_SESSION['koment'] = $_GET['koment']; ?>
		
		<p>Komentarz: <textarea name="komentarz" cols="100" rows="10"></textarea></p>
		<p>Imię/Nazwisko/Pseudonim: <input type="text" name="pseudonim" /></p>
		
		<p><input type="submit" value="Wyślij" /></p>
		<input type="reset" value="Wyczyść" />
	</form>
		
	</body>
</html>
