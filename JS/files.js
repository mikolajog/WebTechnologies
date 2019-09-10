//Do div'a o nazwie files beda trafiac nowe inputy, ktore beda numerowane kolejnymi numerami 
function insertNewFile(){
	var counter = 1;
	var inputs = document.getElementsByTagName('input');
	//liczymy ile inputów 
	for(var i=0; i<inputs.length; i++){
		if(inputs[i].getAttribute('type')=='file'){
			counter = counter + 1; 
		}
	}
	//dodajemy nowy imput do div'a files
	var f1 = "<p><input type=\"file\" name=\"plik"+counter+"\" id=\"plik"+counter+"\"  /></p>"; 
	document.getElementById("files").insertAdjacentHTML( "beforeend", f1);
}