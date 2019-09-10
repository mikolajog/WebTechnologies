//Plik inkludowany przez index.html obraz.html formatowanie.html tabele.html


// Przy opuszczaniu strony ustawiamy cookie styl na ten styl co mamy teraz
window.onunload = function(e) 
{
	var stylNazwa = pobierzAktywnyStyl();
	utworzCookie("styl", stylNazwa, 5);
}

// Przy ladowaniu strony jesli jest cookie to mamy styl, a jak nie to pobierz ten ktory mam teraz
// A jak laduje strone po raz pierwszy to Default
var aktywnyStyl = odczytajCookie("styl");
	
if(aktywnyStyl != null){
		var stylNazwa = aktywnyStyl; 	
}
else{
		var stylNazwa = pobierzAktywnyStyl();
		//if(stylNazwa==null){
		//	stylNazwa="Default"; 
		//}
}
ustawStyl(stylNazwa);


//Znajdujemy w htmlu wszystkie linki i jesli maja ustawiony atrybut title to dodajemy odnosnik do div'a zmianastyli z nazwa tego stylu 
//Przy kliknięciu wywołujemy ustawStyl()
function pokazStyle() 
{
	var list = ""; 
	
	var tab = document.getElementsByTagName("link"); 
	
	for (var i = 0; i<tab.length ; i++) 
	{
		var styl = document.getElementsByTagName("link")[i]; 
		
		if (styl.getAttribute("title")) 
		{
			title = styl.getAttribute("title"); 
			list += "<a href=\"\" onclick=\"ustawStyl(\'" + title + "\');\">Zmień na: " + title + ".</a><br/>"; 
		}
	}
	
	document.getElementById("zmianastyli").innerHTML = list; 
}

//Tak jak w instrukcji, ustawiamy wszystkie styl.disabled = true chyba ze nazwa stylu jest taka sama jak podana w argumencie funkcji i jest unikalna (1. wystąpienie)
//Wtedy ustawiamy styl.disabled na false i ten style bedzie widoczny
function ustawStyl(name) 
{
	var tab  = document.getElementsByTagName("link");
	var unique = true; 
	
	for (var i = 0; i<tab.length; i++) 
	{
		var styl = document.getElementsByTagName("link")[i]; 
		
		if (styl.getAttribute("title")) 
		{
			styl.disabled = true;
			
			if (unique && styl.getAttribute("title") == name)
			{ 
				styl.disabled = false; 
				unique = false; 
			}
		}
	}
}

// Pobieramy i zwracamy aktywny styl na stronie
// Przechodzimy przez wszystkie linki jesli maja atrybut title no i jesli nie sa disabled to zwracamy pierwszy, ktory jest aktywny
function pobierzAktywnyStyl() 
{
	var styl;
	var tab = document.getElementsByTagName("link"); 
	
	for (var i = 0; i<tab.length; i++) 
	{
		styl = document.getElementsByTagName("link")[i];
		
		if (styl.getAttribute("title") && !styl.disabled)
		{ 
			return styl.getAttribute("title");
		}
	}
	return null;
}

// Stworzenie ciastka dla stylu
// nazwa=wartosc;expires=data;path=sciezka domyslnie dla tej strony
function utworzCookie(name, styl, days) 
{
	if (days>0) 
	{ 
		var date = new Date();
		date.setTime(date.getTime() + (days*24*60*60*1000)); 
		var expires = "; expires=" + date.toGMTString(); 
  	}
	else 
	{
		expires = "";
	}
	document.cookie = name + "=" + styl + expires + "; path=/"; 
}

// Odczytujemy ciasteczko w ktorym nazwa jest rowna tej podanej a argumencie
// Zwracamy wartosc ciasteczka
function odczytajCookie(name) 
{
	var name = name + "="; 
	
	var cookieArray = document.cookie.split(';'); 

	for(var i = 0; i < cookieArray.length; i++) 
	{ 
		var c = cookieArray[i];
		
		//ucinamy spacje
		while (c.charAt(0) == ' ') 
		{
			c = c.substring(1, c.length); 
		}
		
		if (c.indexOf(name) == 0)
		{
			return c.substring(name.length, c.length);
		}
	}
	
	return null;
}