<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Blogi</title>
		<script src="walidacjaFormularzy.js" type="text/javascript"></script>
		<script src="chat.js" type="text/javascript"></script>
	</head>
	<body>

<?php 
session_start(); 
$_SESSION['ustawiona'] = true; 
if(isset($_GET['nazwa'])){
	
$nazwa = $_GET['nazwa'];
	
if(!file_exists($nazwa)){ echo"Nie ma takiej strony\n <p><a href=\"fblog.php\">Kliknij, aby dodać blog</a></p>";}

else{
		echo "<h1>Blog: $nazwa</h1>";

		
        $_SESSION['nazwa'] = $nazwa;
	
	include 'menu.php';  
			
		echo "<br/>Opis Bloga: ";
		$fp = fopen("$nazwa/info", "r");
		$s = fgets($fp);
		$s = fgets($fp);
		while (!feof($fp)) {
			$s = fgets($fp);
			echo $s;}
	
		echo"<br/><br/>"; 
		$files = scandir("$nazwa/");
		foreach($files as $file){
	
        if(is_file("$nazwa/".$file) and  preg_match('/\d{16}/',"$file")===1 and preg_match('/\d{16}\./',"$file")!=1 and "$nazwa/".$file != "$nazwa/info"){
			echo "Wpis: ";
		    $fp = fopen("$nazwa/$file", "r");
	
			while (!feof($fp)) {
				$s = fgets($fp);
				echo "<br/>$s";}
			
			
		    foreach($files as $file5)
				if(is_file("$nazwa/".$file5) and  preg_match('/\d{17}.*/',"$file5")===1 and "$nazwa/".$file5 != "$nazwa/info" and substr($file5, 0, 16)=="$file"){
		             echo "<a href=\"$nazwa/$file5\">$file5</a><br/>";}
			
		    echo "<br/>";
		
		    foreach($files as $file1){
				if(is_dir("$nazwa/$file1") and preg_match('/\d{16}\.k/',"$file1")===1 ){
		
		        foreach(scandir("$nazwa/$file1/") as $file3){
					if(is_file("$nazwa/$file1/".$file3) and substr("$file1",0, 16)==="$file"){
						echo "Komentarz: ";
		                $fp1 = fopen("$nazwa/$file1/$file3", "r");
	
			             while (!feof($fp1)) {
				             $s = fgets($fp1);
				             echo "<br/>$s";}             
	                     echo"<br/>";
		
	                }
	             }
		
                }            
		
	         }
		
		    
		    echo"<a href=\"fkomentarz.php?koment=$file\">Kliknij, aby dodać komentarz</a><br/><br/>";
		
	  }
			
	 }
	}}


else{
     echo"<p><a href=\"fblog.php\">Kliknij, aby dodać blog</a></p><br/><br/>";
     echo "<p>Dostępne Blogi:</p>";
      //get all files in specified directory
      $files = glob("*");
 
       //print each file name
      foreach($files as $file){
          //check to see if the file is a folder/directory
           if(is_dir($file)){
                echo"<a href=\"blog.php?nazwa=$file\">$file</a></p>\n";}
       }
}

?>
		
<div class="txt">
<textarea rows="15" cols="40" id="chat" disabled></textarea><br/>
Podaj nick:<br> <input type="text" name="nick" id="nick" /><br/>
Wiadomość: <br/><input type="text" name="message" id="message" /><br/>
<button type="button" value="Wyślij" onclick="if (checkboxZaznaczony() && nickMessageWypelnione()) { send(); } else { alert('Chat jest wyłączony! Prosze go włączyć'); }">Wyślij</button>
<input type="checkbox" name="check" id="check" onchange="update();"/>Uruchom chat<br/>
	
<div id="debug"></div>
</div>
		
	</body>
</html>
