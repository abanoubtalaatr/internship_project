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
// array of  classes error 
let error_to_show  = document.getElementsByClassName('error');

let errors = ['first_name','last_name','email','password','repassword'];
sign_up[0].onclick = function(evt){

	ajaxRequest = new XMLHttpRequest();
	ajaxRequest.onreadystatechange = function() {
  if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
       // if exsits erorr
  	if(ajaxRequest.responseText !== 'done'){
      
       for(let x = 0 ; x <errors.length ; x++){
       	  if(ajaxRequest.responseText.includes(errors[x])){

               let reponse_should_write =
                       ajaxRequest.responseText.replace(errors[x] +':','');
       	  	for(let i = 0 ; i < error_to_show.length;i++){
                 error_to_show[i].textContent = '';
         	  		 let err = errors[x];
                 if(error_to_show[i].classList.contains(err)){	
                   
                   	error_to_show[i].textContent =reponse_should_write;
                    error_to_show[i].style.display = 'block';

                 }
       	   	 
       	     }// end for
       	  }//end if 
       }// end for 
  	   
  	}// end if  exists error

    // else if every thing is ok you will redirect to profile page
    else{
      window.location.assign("../html/profile.php"); 
    }
  	  
		   		   
	}// end if is set response
  }//onchange
	let dataForm = new FormData(document.forms[0]);
	ajaxRequest.open('POST','/internship_project/php/signup.php',true);
	ajaxRequest.send(dataForm);
    
}//end button


