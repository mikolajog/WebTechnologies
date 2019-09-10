<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Formularz zakładania bloga</title>	
		<script src="walidacjaFormularzy.js" type="text/javascript"></script>
	</head>
	<body>
		<h1>Formularz zakładania bloga</h1>
		<?php include 'menu.php';   ?> 
	<form action="nowy.php" method="post">
		<p>Nazwa Bloga: <input type="text" name="nazwaBloga" /></p>
		<p>Nazwa Użytkownika: <input type="text" name="nazwaUzytkownika" /></p>
		<p>Hasło: <input type="password" name="hasło" /></p>
		<p>Opis bloga: <textarea name="opis" cols="100" rows="10"></textarea></p>
		<p> 
			<?php 
	        session_start();
			if(isset($_SESSION['istnieje']) and $_SESSION['istnieje']){
				echo "<p>Taki blog już istnieje. Podaj inny.</p>";
				$_SESSION['istnieje']= false; }
			?>
		</p>
		
		<p><input type="submit" value="Wyślij" /></p>
		<input type="reset" value="Wyczyść" />
	</form>
	</body>
</html>
