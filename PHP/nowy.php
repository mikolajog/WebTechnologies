<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Nowy blog</title>	
		<script src="walidacjaFormularzy.js" type="text/javascript"></script>
	</head>
	<body>
<?php
session_start();

include 'menu.php';  
	
$nazwa_pliku = $_POST['nazwaBloga'];
$_SESSION['nazwa'] = $_POST['nazwaBloga'];

if (file_exists($nazwa_pliku)) 
{
    $_SESSION['istnieje'] = true; 
	header('Location: fblog.php');
} 

else 
{
		mkdir ("$nazwa_pliku", 0777);
		$fp1 = fopen("$nazwa_pliku", "w+");
		//jesli tworzymy nowy blog i w tym samym czasie utworzymy katalog no to otwieramy info.txt i probujemy go zablokowac, jesli nam sie uda i plik w pliku nic nie ma jeszcze no to supcio, a jak nie no to zamykamy, stiwerdzamy ze juz istnieje taki blog i powracamy do formularza z informacja ze juz taki blog istnieje
		flock($fp1 ,LOCK_EX); 

		$fp = fopen("$nazwa_pliku/info", "w+");
		if ($fp != FALSE and filesize("$nazwa_pliku/info")==0)
		{
		 fputs($fp, $_POST['nazwaUzytkownika']."\n");
		 fputs($fp, md5($_POST['hasło'])."\n");
		 fputs($fp, $_POST['opis']."\n");
		}
		else{
			fclose($fp);
			$_SESSION['istnieje'] = true; 
			header('Location: fblog.php');
		}
		fclose($fp);
		fclose($fp1);

		header("Location: blog.php?nazwa=$nazwa_pliku");
	}
?>
	</body>
</html>
