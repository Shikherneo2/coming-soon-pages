// JavaScript Document
function textarea_blur(obj){
	if(!obj.value) 
		obj.value=' List out your suggestions is less than 150 words.';
}
function check(){
	var box = document.getElementById('newsletter');
	if(box.checked)
		box.checked = false;
	else
		box.checked = true;	
}

function validateEmail(){
	var x = document.getElementById('email').value;
	
	var lengthOK = ( x.length <= 50 )? 1 :0;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	
	if ( lengthOK==0 || atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length )
		return false;
	else
		return true;
}

function validate(){
	var name_Element = document.getElementById('name');
	var wishlist_Element = document.getElementById('wishlist');
	var regEx = new RegExp("[^a-zA-Z- ]+");
	var problem = 0;
	
	if ( regEx.test(name_Element.value) || name_Element.value.length == 0)
		problem = 1;
	else if( wishlist_Element.value.length>1500 )
		problem = 2;
	else if	( wishlist_Element.value.length==0 )
		problem = 3;
	else if( !validateEmail() )
		problem = 4;
	else{ 
		document.getElementById('mainForm').submit();
		return;
	}
	
	switch(problem){
		case 1:	
				document.getElementById('response').innerHTML = 'The Name you Entered Appears invalid. Please Try Again';
				name_Element.focus();
				break;
		
		case 2:	
				document.getElementById('response').innerHTML = 'Your Response is too long. Could you trim it down a little.';				
				wishlist_element.focus();
				break;
		
		case 3:	
				document.getElementById('response').innerHTML = 'You cannot leave the Suggestion box blank.';
				document.getElementById('email').focus();
				break;
		
		case 4:	
				document.getElementById('response').innerHTML = 'The Email you Entered Appears invalid. Please Try Again';
				document.getElementById('email').focus();
				break;
		
	}
}