//sprawdzam czy checkbox jest zaznaczony
function checkboxZaznaczony() {
	return document.getElementById("check").checked;
}

//sprawdzam czy jest coś w nicku i wiadomości
function nickMessageWypelnione() {
	return document.getElementById("nick").value && document.getElementById("message").value;
}

//Update'owanie chatu
function update() 
{
	document.getElementById("chat").innerHTML = "";

	var xmlhttp;
	
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} 
	
	xmlhttp.onreadystatechange=function() 
	{
		if (xmlhttp.readyState==3 && xmlhttp.status==200) 
		{
			if (checkboxZaznaczony()) 
			{
				document.getElementById("chat").innerHTML=xmlhttp.responseText;
			}
		}
		
		if (xmlhttp.readyState==4) 	
		{
			xmlhttp.open("GET","messages.php",true); 
			xmlhttp.send(); 
		}
			
	}
	
	xmlhttp.open("GET", "messages.php", true);
	xmlhttp.send();
	
}

// Wysyłanie
function send() 
{
	var xmlhttp;
	
	if (window.XMLHttpRequest) 
	{
		xmlhttp=new XMLHttpRequest();
	} 
	
	var nickValue = encodeURIComponent(document.getElementById("nick").value); // Pobranie nicku
	var messageValue = encodeURIComponent(document.getElementById("message").value); // Pobranie wiadomosci

	xmlhttp.open("GET", "send.php?nick="+nickValue+"&message="+messageValue, true);
										
	xmlhttp.send();

	document.getElementById("message").value = ""; 
} 