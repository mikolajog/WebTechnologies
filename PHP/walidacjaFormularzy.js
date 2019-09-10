function getDate(){
	
   var todaydate = new Date();
	
	var date = new Date();
	
	var currentHours = date.getHours();
	var currentHours = ("0" + currentHours).slice(-2);
	
	var currentMinutes = date.getMinutes();
	var currentMinutes = ("0" + currentMinutes).slice(-2);
	
	var timestring = currentHours +":"+ currentMinutes; 
	document.getElementById("godzina").value = timestring;
	
	
   var day = todaydate.getDate();
	var day = ("0" + day).slice(-2);
	
   var month = todaydate.getMonth() + 1;
	var month= ("0" + month).slice(-2);
	
   var year = todaydate.getFullYear();
   var datestring = year+"-"+month+"-"+day;
	
   document.getElementById("data").value = datestring;
 }

function checkValidity(){
	
var button = document.getElementById('wyslij');

button.addEventListener('click', function(e) {
    var textBox = document.getElementById('data');

	var patt = new RegExp("^[1-9][0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$");
	
	var p1 = parseInt((textBox.value).substr(0,3));
	var p2 = parseInt((textBox.value).substr(5,6));
	var p3 = parseInt((textBox.value).substr(8,9));
	
	var warunek = false; 
	
	if((p2=="01" || p2=="03" || p2=="05" || p2=="07" || p2=="08" || p2=="10" || p2=="12") && (p3<=31)&&(p3>0) ){
		warunek=true;
	}
	if((p2=="04" || p2=="06" || p2=="09" || p2=="11") && (p3<=30) && (p3>0) ){
		warunek=true;
	}
	if((p2=="02") && (p3<=29) && (p3>0) ){
		warunek=true;
	}
	
    if (patt.test(textBox.value) && warunek) {
		textBox.setCustomValidity(''); 
		getDate(); 
    } 
	else {
		e.preventDefault();
        textBox.setCustomValidity('Zla data');
    }
	
	var textBox1 = document.getElementById('godzina');
	
	var patt1 = new RegExp("^[0-2][0-9]:[0-9][0-9]$");
	
	var p4 = parseInt((textBox1.value).substr(0,2));
	var p5 = parseInt((textBox1.value).substr(3,4));
	
	var warunek1 = false; 
	
	if((p4<=23) && (p5<=59)){
		warunek1=true;
	}
	
    if (patt1.test(textBox1.value) && warunek1 ) {
        textBox1.setCustomValidity('');
		getDate();
    } 
	else {
		e.preventDefault();
        textBox1.setCustomValidity('Zla godzina');
	
    }
	 
});
} 






