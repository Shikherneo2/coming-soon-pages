// JavaScript Document
function validateForm()
{
	var x = document.getElementById('email').value;
	var lengthOK = ( x.length <= 50 )? 1 :0;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if ( lengthOK==0 || atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length ){
		document.getElementById('response').innerHTML = ' &nbsp;The Email Address you entered does not appear valid. Please try Again &nbsp;';
	}
	else
		formMain.submit();
		
}
function has_focus(obj){
	obj.select();
	obj.style.color = "#000";
}
function isEmpty(obj){
	if(!obj.value){
	obj.style.color = "#515151";
	obj.value = "Enter Your Email";
	}
}
