/*
 # this belong sign_up file 

# this code for sign up button to send request to file php 
  to check it valid or not if valid will redirect it 
  to the profile page else will show what it is the error your should fix it
*/


 // this to get button call sign_up in sign up file

let sign_up = document.querySelectorAll('.col button'),
    value_of_form = document.querySelectorAll('form .col input , form .col select '),
    classes_error = document.getElementsByClassName('error'),
    placeholder ='',
    single_placeholder;
   

// ****   Start Validation *** //

// this for stor placeholder and show it when make blur or foucs   
for(let i = 0 ; i < value_of_form.length ; i++){
	 placeholder += value_of_form[i].getAttribute('placeholder') +",";
	 single_placeholder = placeholder.split(',');
}   

for(let i = 0 ; i < value_of_form.length ; i++ ){
	// in this function check after not foucs on input if the input empty or not
	value_of_form[i].onblur  = function (){
	   if(value_of_form[i].value ==''){ 
	   	  value_of_form[i].classList.add('warning');
	   	  value_of_form[i].setAttribute('placeholder','Empty');
	   } // End check if empty or not
	   else if(value_of_form[i].value.length < 3){
		   value_of_form[i].classList.add('warning');  
	   }
	}
	
	value_of_form[i].onfocus= function(){
       placeholder = value_of_form[i].getAttribute('placeholder');
       value_of_form[i].classList.remove('warning');
       value_of_form[i].setAttribute('placeholder', single_placeholder[i]);

	}
}


// *** End the validation *** // 

sign_up[0].onclick = function(evt){

	ajaxRequest = new XMLHttpRequest();
	ajaxRequest.onreadystatechange = function() {
  if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
  	// here to receive the response if no error you will redirect to this page
	// window.location.replace('php/sign_up.php');
		   		   
	}// end if is set response
  }//onchange
	let dataForm = new FormData(document.forms[0]);
	ajaxRequest.open('POST','/project/php/signup.php',true);
	ajaxRequest.send(dataForm);
}//end button

