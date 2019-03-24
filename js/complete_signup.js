let check_code = document.getElementById('check_code'),
    code = document.getElementById('code');

let url =window.location.href;
let index = url.indexOf('?');
let email1 = url.substr(index + 1);
let index2 = email1.indexOf('=');
let email = email1.substr(index2+1);

check_code.onclick = function (evt){
	evt.preventDefault();
	ajaxRequest = new XMLHttpRequest();
	ajaxRequest.onreadystatechange = function() {
  if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
  	  if(ajaxRequest.responseText =='done')
  	  {
  		window.location.assign("../html/profile.php"); 
  	  }
  	  else if(ajaxRequest.responseText == "wrong code")
  	  {
  		  alert(ajaxRequest.responseText);
  	  }
  	  else if(ajaxRequest.responseText == "curious")
  	  {
  		  alert("Do Not Try this again");
  	  }
		   		   
	}// end if is set response
  }//onchange
	
	ajaxRequest.open('POST','../php/signup.php',true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send("code=" + code.value +"&email="+email+ "&fun=check_code");
	
}