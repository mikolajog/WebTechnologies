<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Strona główna</title>	
		<script src="walidacjaFormularzy.js" type="text/javascript"></script>
	</head>
	<body>
<?php session_start();

include 'menu.php';  

$nazwaB = $_SESSION['nazwa'];
$koment = $_SESSION['koment']; 
		
$nazwa = $koment.".k"; 

mkdir ("$nazwaB/$nazwa", 0777);

$nieJestemTutajPierwszy = true; 

//zapętlamy to, wchodze do petli while, zakladam ze nie jestem pierwszy, sprawdzam możliwa nazwe dla komentarza o 0..., otwieram plik, potem probuje go zablokowac przy zalozeniu ze plik jest pusty, jesli mi sie uda to super, wrzucam dane do niego co chce, wpisuje jednak bylem pierwszy i papa, jezeli nie moge zablokowac pliku bo juz jest zablokowany to znaczy ze nie byle pierwszy i od nowa lece petla, a jezeli moge go zablokowac, ale rozmiar pliku jest wiekszy od zera to znaczy, ze jak przydzielo mi nazwe pliku to ktos byl w trakcie tworzenia tego samego i zanim ja doszedlem do blokowania pliku to ktos juz go zamknąl, wiec dopisalbym zmiany do jego komentarza, ale nieee, ja jestem sprytny i dalej uwazam ze nie bylem pierwszy i od nowa przydzielam sobie nowa nazwe pliku, tym razem oby juz byla wolna
while($nieJestemTutajPierwszy){
	
$warunek=true;
	
$nazwa_pl = "0";
	
$var=false;
	for($i=0; $var==false; $i++){
    $nazwa_pl = "$i";
	$var=true;
	if(file_exists("$nazwaB/$nazwa/$nazwa_pl")){
		$var=false;}
}

$date = date("d");
$month = date("m");
$year = date("Y");
$hour = date("H");
$min = date("i");
$sec = date("s");


$fp1 = fopen("$nazwaB", "w+");
flock($fp1 ,LOCK_EX); 
	
$fp = fopen("$nazwaB/$nazwa/$nazwa_pl", "w+");
	
if ($fp!=FALSE and filesize("$nazwaB/$nazwa/$nazwa_pl")==0)
        {
        fputs($fp, $_POST['rodzajKomentarza']."\n");
        fputs($fp, $year ."-".$month."-".$date.", ".$hour.":".$min.":".$sec."\n");
        fputs($fp, $_POST['pseudonim']."\n");
        fputs($fp, $_POST['komentarz']."\n");
        $nieJestemTutajPierwszy = false;
        }
fclose($fp);
fclose($fp1);
}

header("Location: blog.php?nazwa=$nazwaB");

?>
	</body>
</html>