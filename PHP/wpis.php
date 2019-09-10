<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Nowy wpis</title>
		<script src="walidacjaFormularzy.js" type="text/javascript"></script>
	</head>
	<body>
<?php 
session_start();

include 'menu.php';  

$haslo_zakodowane = md5($_POST['hasło'])."\n";
$nazwa_podana = $_POST['nazwaUzytkownika']."\n";

$files = glob("*");
foreach($files as $file){
	if(is_dir($file)){
		$fp = fopen("$file/info", "r");
		$nazwa_plik = fgets($fp);
		$haslo_plik = fgets($fp);
		if($nazwa_podana==$nazwa_plik and $haslo_plik == $haslo_zakodowane ){
			$nazwaB=$file; 
		}
	}
}


//$nazwaB = $_SESSION['nazwa'];

$fp = fopen("$nazwaB/info", "r");
$nazwa_plik = fgets($fp);
$haslo_plik = fgets($fp);

	if($nazwa_podana==$nazwa_plik and $haslo_plik == $haslo_zakodowane ){
		$podanaData = $_POST['daty'];

		$year = substr($podanaData, 0, 4);  
		$month = substr($podanaData, 5,2);  
		$day = substr($podanaData, 8,2);  
		
		$podanaGodz = $_POST['godzina'];

		$hour= substr($podanaGodz, 0, 2);  
		$minute = substr($podanaGodz, 3,2);  
		
		
		$sec = date("s");
		$num = 11; 
		
		$nazwa_pliku = $year.$month.$day.$hour.$minute.$sec."$num";
		
		
		//i znowu, zakladamy ze nie jestesmy pierwsi, sprawdzamy jaki mozemy miec unikalny numer, otwieramy jesli mozemy blokujemy plik, wpisujemy i papa, potem tworzymy dodajemy zalczniki, jesli nie moglismy zablokowac pliku lub juz cos w tym pliku bylo no to dajemy od nowa zabawe, dodajemy kolejny numerek no i sprawdzamy czy istnieje... potem dodajemy zalczniki i bye bye
		$nieJestemTutajPierwszy = true; 
        while($nieJestemTutajPierwszy){
		
		while (file_exists($nazwa_pliku)){
			$num=$num+1;
			$nazwa_pliku = $year.$month.$day.$hour.$minute.$sec."$num";} 
		
		
		$fp = fopen("$nazwaB/$nazwa_pliku", "w+");
			
		flock($fp ,LOCK_EX); 
		if (filesize("$nazwaB/$nazwa_pliku")==0)
        {
        fputs($fp, $_POST['daty']."\n");
		fputs($fp, $_POST['godzina']."\n");
		fputs($fp, $_POST['wpis']."\n");
		$nieJestemTutajPierwszy = false;
        }
	    fclose($fp);
		}
		
		$targetdir = "$nazwaB/";   
		$counter = 1; 
		
		while (isset($_FILES["plik".$counter])){
			
			$ext1 =substr($_FILES["plik".$counter]['name'], strrpos($_FILES["plik".$counter]['name'], ".")); 
			$targetfile1 = $targetdir.$nazwa_pliku.$counter.$ext1;
			move_uploaded_file($_FILES["plik".$counter]['tmp_name'], $targetfile1); 
			$counter = $counter + 1; 
		}
		
		header("Location: blog.php?nazwa=$nazwaB");
}

else{
	$_SESSION['badpin'] = true; 
	header('Location: fwpis.php');
}
		
?>
	</body>
</html>
