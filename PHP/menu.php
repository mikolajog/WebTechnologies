<?php 
session_start();
echo"<p><a href=\"blog.php\">Strona główna</a></p>";
echo"<p><a href=\"fblog.php\">Kliknij, aby dodać blog</a></p>";
if(isset($_SESSION['nazwa'])){
echo"<p><a href=\"fwpis.php\">Kliknij, aby dodać wpis</a></p>";}
?> 