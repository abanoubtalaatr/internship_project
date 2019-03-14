
let forget_password = document.getElementById('forget_password'),
    alert_class = document.getElementsByClassName('alert-danger');
   

forget_password.onclick = function(evt){
	if(document.querySelectorAll('.form-group #exampleInputEmail1')[0].value !=='')
	{
	   
	    var email = document.querySelectorAll('.form-group #exampleInputEmail1')[0].value;
		
	    let req = new XMLHttpRequest();
        req.onreadystatechange = function()
        {
            if (req.status === 200 && req.readyState === 4)
            {
                if (req.responseText != "")
                {
                	window.location.assign("../html/reset_password.php?email=" + email); 

                }
            }
        };
        req.open("POST", "../php/login.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("email=" + email + "&fun=send_code");
	    
	}

}
