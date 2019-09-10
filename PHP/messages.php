<?php 

$fp = fopen("wiadomosci.txt", "r");
	while (!feof($fp)) {
		echo fgets($fp);
	}
fclose($fp); 
?>