let check_code = document.getElementById('check_code'),
    code = document.getElementById('code'),
    form_id = document.querySelectorAll('form');
check_code.onclick = function (evt){
	evt.preventDefault();
	ajaxRequest = new XMLHttpRequest();
	ajaxRequest.onreadystatechange = function() {
  if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
  	  if(responseText =='done'){
         form_id[1].style.display = 'none';
         form_id[0].style.display = 'block';
  	  }
		   		   
	}// end if is set response
  }//onchange
	
	ajaxRequest.open('POST','/internship_project/php/reset_password.php',true);
	ajaxRequest.send(code.value);
	
}