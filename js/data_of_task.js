let start_task = document.getElementById('start_task'),
    alert = document.getElementsByClassName('alert'),
    tasks = document.querySelectorAll('.tasks .row');
   

start_task.onclick = function (evt){
	evt.preventDefault();
	alert[0].style.display = 'none';
	this.style.display = 'none';

	ajaxRequest = new XMLHttpRequest();
	ajaxRequest.onreadystatechange = function() {
  if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
         
  	   let json = JSON.parse(ajaxRequest.response);
  	   // this for create div contain discription for this task
  	   let div_description = document.createElement('div');
  	       div_description.innerHTML = "<span> description task </span>" +"<p>"+ json[0] + "</p>";
  	       div_description.setAttribute('class' ,'description');

  	   // this div for contain two spans 
  	   let div_span = document.createElement('div');
  	       div_span.setAttribute('class','contain_span');

  	   // this span for contain start task
  	   let span_start = document.createElement('span');
  	       span_start.innerHTML = "<strong> task Start in : </strong>"+json[1];
  	   // this span for contan end task
  	   let span_end = document.createElement('span');
  	       span_end.innerHTML = "<strong> task End in : </strong>"+ json[2];
  	   // append two spans in div_span
  	   div_span.appendChild(span_start);
  	   div_span.appendChild(span_end);  
  	   //creat form to contain button upload and submit
  	   let form = document.createElement('form');
  	       form.setAttribute('enctype','multipart/form-data');

       // button upload 
       let button_upload = document.createElement('button');
           button_upload.innerHTML ="<span> Upload Task </span>"
            +"<input type ='file' id='file' name ='my_file'>";
           button_upload.setAttribute('class','btn btn-primary');
           button_upload.setAttribute('id','upload_task');
       //button submit
       let button_submit = document.createElement('button');
           button_submit.innerHTML = 'Submit Task';
           button_submit.setAttribute('class','btn btn-primary upload');
           button_submit.setAttribute('id','submit_task');
           button_submit.setAttribute('value','sumbit');

        form.appendChild(button_upload);
        form.appendChild(button_submit);

       // this for append the div that contain spans and div contain description
       // div contain upload button 
  	   tasks[0].appendChild(div_span);
  	   tasks[0].appendChild(div_description);
  	   tasks[0].appendChild(form);



		// this for upload task form your machine (computer or laptop to server)

		let submit_task = document.getElementById('submit_task');
		let file = document.getElementById('file');

		submit_task.onclick = function (evt){
			evt.preventDefault();
			
			if(file.value !==''){
				
				ajaxRequest2 = new XMLHttpRequest();
			
				ajaxRequest2.onreadystatechange = function() {
				  if(ajaxRequest2.readyState == 4 && ajaxRequest2.status == 200){
				  	  if(ajaxRequest2.response ==''){
				  	  	 tasks[0].removeChild(div_description);
				  	  	 tasks[0].removeChild(div_span);
				  	  	 tasks[0].removeChild(form);
				  	  	 let alert = document.createElement('div');
				  	  	     alert.innerHTML = 'you will recieve the result within from 1-3 minute';
				  	  	     alert.setAttribute('class' ,'btn btn-danger');
				  	  	 tasks[0].appendChild(alert);
				  	  }
						   		   
					}// end if is set response
				  }//onchange
				
				let dataForm = new FormData(this.parentNode);
				ajaxRequest2.open('POST','/internship_project/tasks/manager_tasks.php',true);
				
				ajaxRequest2.send(dataForm);
			
			}//end if 
			
		}// upload_task

		   		   
	}// end if is set response
  }//onchange
	
	ajaxRequest.open('POST','/internship_project/php/data_of_task.php',true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send();
	
}//  end start task 
