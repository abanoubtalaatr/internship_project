<?php 
class task_soluation
{
    private $con;
    public function task_soluation($server_name , $db_user , $db_pass , $db_name)
    {
        $this->con = new mysqli($server_name , $db_user , $db_pass , $db_name);
    }
    public function get_result($task_number , $id)
    {
        
        $select = "SELECT task_".$task_number."_degree , task_".$task_number."_total_degree FROM tasks_degree WHERE id='" . $id . "'";
        $res = $this->con->query($select);

        if($res->num_rows == 1)
        {
            while($row = $res->fetch_assoc())
            {
                $degree = $row["task_".$task_number."_degree"];
                $total_degree = $row["task_".$task_number."_total_degree"];
                if($degree == 0 && $total_degree == 0)
                {
                    //it is meaning that is error on the structure of file

                    return "Error on the structure of file";
                }
                else if($total_degree > 0)
                {
                    //here every thing good we will return the degree with percentage
                    if($degree > 0)
                        $result = ( $degree / $total_degree ) * 100;
                    else
                        $result = 0;

                    return $result;
                }
            }
        }     
        
    }
    
    public function correct_this($task_number , $id , $recive_date_of_tak)
    {
        
        $task_name = $id . "_task_" . $task_number . ".php";
        $path_file = "../tasks/" . $task_name;

        $degree = array();
        $user_degree =0;
        $total_degree =0;

        //first we will store in database that the user recive a task
        $insert = "UPDATE tasks_degree SET task_".$task_number."_recive_date='" . $recive_date_of_tak."' WHERE id='" . $id . "'";
        $this->con->query($insert);

        if($task_number == 1)
        {
            
           $degree =  $this->task_1_correction($path_file);
           $user_degree = $degree[0];
           $total_degree = $degree[1];
           $error = $degree[2];

            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
           $update = "UPDATE tasks_degree SET task_1_degree = '".$user_degree."' , task_1_total_degree ='".$total_degree."' , task_1_notes ='".$notes."' WHERE  id ='".$id."'" ;
        
           $this->con->query($update);
        }
        else if($task_number == 2)
        {
            $degree = $this->task_2_correction($path_file);
            $user_degree = $degree[0];
            $total_degree = $degree[1];
            $error = $degree[2];
            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
            $update = "UPDATE tasks_degree SET task_2_degree ='" . $user_degree."' , task_2_total_degree = '".$total_degree."' , task_2_notes ='".$notes."'  WHERE  id='".$id . "'";
        
           $this->con->query($update);
            
        }
        else if($task_number == 3)
        {
            $degree = $this->task_3_correction($path_file);
            $user_degree = $degree[0];
            $total_degree = $degree[1];
            $error = $degree[2];
            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
            $update = "UPDATE tasks_degree SET task_3_degree = '".$user_degree."' , task_3_total_degree = '".$total_degree."' , task_3_notes ='".$notes."'  WHERE  id = '".$id."'" ;
        
           $this->con->query($update);
        }
        else if($task_number == 4)
        {

            $degree = $this->task_4_correction($path_file);
            $user_degree = $degree[0];
            $total_degree = $degree[1];
            $error = $degree[2];
            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
            $update = "UPDATE tasks_degree SET task_4_degree = '".$user_degree."' , task_4_total_degree = '".$total_degree."' , task_1_notes ='".$notes."'  WHERE  id = '".$id."'" ;
        
           $this->con->query($update);
        }
    }
    /*
     * this first task
     * the task :: class named task and contain function named check_name and have one  paramter named name
     *  return correct if name not empty
     *                 name length >= 3 and <=20 
     *                 name do not have a number 
     *                 name do not have any space
     *                 name do not have any tag
     *                            
     *  return wrong if any thing 
     */
    private function task_1_correction($path_file)
    {
        require_once $path_file;
        
        $task = new task();

        $wrong = array();
        $wrong[0] = "";
        $wrong[1] = "al";
        $wrong[2] = "asdryuimngyuioplkjhgd";
        $wrong[3] = "bassem55";
        $wrong[4] = "bassem reda";
        $wrong[5] = "<script>anything</script>";

        $correct = array();
        $correct[0] = "abanoub";
        $correct[1] = "ali";
        $correct[2] = "bassem";

        $notes = array();
        $counter = 0;

        $degree = 0;
        for($i=0;$i<count($wrong);$i++)
        {
            if($task->check_name($wrong[$i]) === "wrong")
            {
                $degree++;
            }
            else if($task->check_name($wrong[$i]) === "correct")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }   
        }
        for($i=0;$i<count($correct);$i++)
        {
            if($task->check_name($correct[$i]) === "correct")
            {
                $degree++;
            }
            else if($task->check_name($correct[$i]) === "wrong")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }
        }

        $arr = array();
        $arr[0] = $degree;//degree
        $arr[1] = count($wrong) + count($correct);//total degree 
        $arr[2] = $notes;
        return $arr;
    }
    /*
        this secand task

        it is about valid phone number

        write in file class named task 
        and function check_phonenumber
        will take one paramter(phone number)
        and will return correct if the length of phone number 11
                                    will start with 010 or 012 or 011
                                    make sure that the number not contain any character

        return wrong if anything else

    */
    private function task_2_correction($path_file)
    {
        require_once $path_file;

        $task = new task();
        $wrong = array();

        $wrong[0] = "0120287465";//10 
        $wrong[1] = "012028736166";//12
        $wrong[2] = "012012";//6
        $wrong[3] = "01302873616";//12 but start with 013
        $wrong[4] = "01702873616";//12 but start with 017
        $wrong[5] = "012e45mu576";//12 but contain characters

        $correct = array();

        $correct[0] = "01201873616";
        $correct[1] = "01102764837";
        $correct[2] = "01098237673";
       
        $degree = 0;
        $notes = array();
        $counter = 0;

        $degree = 0;
        for($i=0;$i<count($wrong);$i++)
        {
            if($task->check_phonenumber($wrong[$i]) == "wrong")
            {
                $degree++;
            }
            else if($task->check_phonenumber($wrong[$i]) == "correct")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }   
        }
        for($i=0;$i<count($correct);$i++)
        {
            if($task->check_phonenumber($correct[$i]) == "correct")
            {
                $degree++;
            }
            else if($task->check_phonenumber($correct[$i]) == "wrong")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }
        }

        $arr = array();
        $arr[0] = $degree;//degree
        $arr[1] = count($wrong) + count($correct);//total degree 
        $arr[2] = $notes;
        return $arr;
    }
    /*
        therd task :: email validation

        write class name task contain public function name check_email
        
        take one parameter (email)
        return correct if vaild email and
                          email is @gmail.com or @yahoo.com
                          make sure that email do not have any space
                          make sure that not empty email
        return wrong if any thing else

    */
    private function task_3_correction($path_file)
    {
        require_once $path_file;

        $task = new task();
        $wrong = array();

        $wrong[0] = "";//empty
        $wrong[1] = "bassem reda@gmail.com";//space
        $wrong[2] = "bassemreda@anything.com";//not gmail or yahoo
        $wrong[3] = "bassem#gmail.com";//# not @
        $wrong[4] = "bassem@gmail.com@gmail.com";//@gmail.com written two times
        $wrong[5] = "bassem@gmailcom";
        $correct = array();

        $correct[0] = "bassemreda55@gmail.com";
        $correct[1] = "abanoub@yahoo.com";
        $correct[2] = "bassem@yahoo.com";

        $notes = array();
        $counter = 0;

        $degree = 0;
        for($i=0;$i<count($wrong);$i++)
        {
            if($task->check_email($wrong[$i]) == "wrong")
            {
                $degree++;
            }
            else if($task->check_email($wrong[$i]) == "correct")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }   
        }
        for($i=0;$i<count($correct);$i++)
        {
            if($task->check_email($correct[$i]) == "correct")
            {
                $degree++;
            }
            else if($task->check_email($correct[$i]) == "wrong")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }
        }

        $arr = array();
        $arr[0] = $degree;//degree
        $arr[1] = count($wrong) + count($correct);//total degree 
        $arr[2] = $notes;
        return $arr;

    }
    /*
        use last tasks to create function signup that his job
        make validate for inputs and store it if vaild

        create class name task that have 
        function name signup that will take four parameters
        ==>first_name
        ==>last_name
        ==>email
        ==>password

        make validation for all parameters

        if everything good  return correct

        if atleast one parameter wrong return wrong

        
    */
    private function task_4_correction($path_file)
    {
        require_once $path_file;

        $task = new task();

        $correct_name = array();
        $correct_name[0] = "abanoub";
        $correct_name[1] = "ali";
        $correct_name[2] = "kero";
        $correct_name[3] = "bassem";
        $correct_name[4] = "namewithoutspace";
        $correct_name[5] = "namewithouttag";

        $correct_email = array();
        $correct_email[0] = "bassemreda55@gmail.com";
        $correct_email[1] = "abanoub@yahoo.com";
        $correct_email[2] = "bassem@yahoo.com";
        $correct_email[3] = "abanoub@gmail.com";
        $correct_email[4] = "kero@yahoo.com";
        $correct_email[5] = "marco@gmail.com";

        $correct_password = array();
        $correct_password[0] = "bassem12";
        $correct_password[1] = "bassem12345";
        $correct_password[2] = "<bassemreda55>";
        $correct_password[3] = "<script>bassem55</scropt>";
        $correct_password[4] = "1234bassem34";
        $correct_password[5] = "abanoub<>s55";

        $wrong_name = array();
        $wrong_name[0] = "";
        $wrong_name[1] = "al";
        $wrong_name[2] = "asdryuimngyuioplkjhgd";
        $wrong_name[3] = "bassem55";
        $wrong_name[4] = "bassem reda";
        $wrong_name[5] = "<script>anything</script>";

        $wrong_email = array();
        $wrong_email[0] = "";//empty
        $wrong_email[1] = "bassem reda@gmail.com";//space
        $wrong_email[2] = "bassemreda@anything.com";//not gmail or yahoo
        $wrong_email[3] = "bassem#gmail.com";//# not @
        $wrong_email[4] = "bassem@gmail.com@gmail.com";//@gmail.com written two times
        $wrong_email[5] = "bassem@gmailcom";

        $wrong_password = array();
        $wrong_password[0] = "12345678";//do not have char
        $wrong_password[1] = "basemreda";//do not have a number
        $wrong_password[2] = "bassem5";//7 digit
        $wrong_password[3] = "";
        $wrong_password[4] = "marco";
        $wrong_password[5] = "<><><>";

        $degree = 0;
        for($i=0;$i<count($wrong_email);$i++)
        {
            $result_correct = $task->signup($correct_name[$i] , $correct_name[$i] , $correct_email[$i] , $correct_password[$i]);
            $result_wrong   = $task->signup($wrong_name[$i] , $wrong_name[$i] , $wrong_email[$i] , $wrong_password[$i]);

            $notes = array();
            $counter = 0;
            if($result_wrong == "wrong")
            {
                $degree++;
            }
            else
            {
                $notes[$counter] =  "(".$wrong_name[$i]." , ".$wrong_name[$i]." , ".$wrong_email[$i]."  , ".$wrong_password[$i].")";
                $counter++;
            }

            if($result_correct == "correct")
            {
                $degree++;
            }
            else if($result_correct == "wrong")
            {
                $notes[$counter] =  "(".$correct_name[$i]." , ".$correct_name[$i]." , ".$correct_email[$i]."  , ".$correct_password[$i].")";
                $counter++;
            }
            
        }
        $arr = array();
        $arr[0] = $degree;//degree
        $arr[1] = count($wrong) + count($correct);//total degree 
        $arr[2] = $notes;
        return $arr;
       
    }

}
?>
<?php

/*
    if you want correct the task go the following steps
    ==>send first post request with variables id , task_number , fun=="check_task" , recive_date (of task)
        nothing will return
    
    ==>send secand post request with variables id , task_number , fun=="get_result"
        will return degree with percentage (%) if everything ok
        will return "Error on the "Error on the structure of file"

*/
    if(isset($_POST['id']) && isset($_POST['task_number']) && isset($_POST['fun']) && isset($_POST['recive_date']))
    {
        if($_POST['fun'] == "check_task")
        {
            $task = new task_soluation("localhost" , "root" , "" , "project");
            $task->correct_this($_POST['task_number'] , $_POST['id'] , $_POST['recive_date']);
        }
        else if($_POST['fun'] == "get_result")
        {
            $task = new task_soluation("localhost" , "root" , "" , "project");
            echo $task->get_result($_POST['task_number'] , $_POST['id']);
        }
    }
?>
