<?php 
$nick = $_GET['nick'];
$mes = $_GET['message'];
$fp = fopen("wiadomosci.txt", "r");
$fp1 = fopen("pomoc.txt", "w+");
$counter =0; 

while (!feof($fp)) {
	fputs($fp1, fgets($fp));
	$counter = $counter+1; 
	
}
fclose($fp);
fclose($fp1);

if($counter<=4){
	$fp = fopen("wiadomosci.txt", "a");
	fwrite($fp, $nick.": ".$mes."\n"); 
	fclose($fp); 
}
else{
	$fp1 = fopen("pomoc.txt", "r");
	$fp = fopen("wiadomosci.txt", "w+");
	$w = fgets($fp1);
	while (!feof($fp1)) 
	{
		fputs($fp, fgets($fp1));
	}
	fputs($fp, $nick.": ".$mes."\n");
	
	fclose($fp);
	fclose($fp1);
	
}

?>
