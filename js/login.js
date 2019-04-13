let login = document.getElementById('login'),
    email = document.getElementById('exampleInputEmail1'),
    password = document.getElementById('exampleInputPassword1');

login.onclick = function (evt){
	
	evt.preventDefault();
	ajaxRequest = new XMLHttpRequest();
	ajaxRequest.onreadystatechange = function() {
  if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
  	  if(ajaxRequest.response =='done'){
  	  	 window.location.assign("../html/profile.php"); 
  	  }
		   		   
	}// end if is set response
  }//onchange
	
	ajaxRequest.open('POST','/internship_project/php/login.php',true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send('email='+email.value+"&password="+password.value);
	
}