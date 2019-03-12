
let forget_password = document.getElementById('forget_password'),
    alert_class = document.getElementsByClassName('alert-danger');
   

forget_password.onclick = function(evt){
	if(document.querySelectorAll('.form-group #exampleInputEmail1')[0].value !==''){
	    alert_class[0].style.display = 'block';
	}

    window.setTimeout(function(){
       alert_class[0].textContent = 'you will redirect now';
        window.location.href = "reset_password.php";

    }, 6000);

}

