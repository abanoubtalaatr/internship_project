<?php
class login
{
    private $email;
    private $pass;

    private $con ;

    private $error_arr = array();
    
    public function login($server_name , $db_user , $db_pass , $db_name)
    {
        $this->con = new mysqli($server_name , $db_user , $db_pass , $db_name);
    }
    public function start_login($email , $pass)
    {
        $this->email = $email;
        $this->pass = $pass;

        //we want know the input email or phone number
        //we will allow gmail and yahoo emails and we can allow any email type by add condition on if
        if($this->is_email($this->email,"gmail.com") || $this->is_email($this->email , "yahoo.com"))
        {

            $email = $this->con->real_escape_string($this->email);
            if ($this->email_found($this->email) == true)//first check if email founded in database or not
            {
                if ($this->check_pass($this->pass) == "good")//if pass just number and chars
                {
                    $select = $this->con->query("SELECT  password FROM login WHERE email ='" . $email . "' AND password ='" . $this->pass . "'");

                    if ($select->num_rows == 1) 
                    {
                        $this->error_arr[0] = "done";
                        return $this->error_arr;
                    }
                    else
                    {
                        $this->error_arr[0] = "password";
                        $this->error_arr[1] = "Un Correct Password";
                        return $this->error_arr;
                    }
                       
                }
                else if ($this->check_pass($this->pass) == "names" || $this->check_pass($this->pass) == "tag" || $this->check_pass($this->pass) == "special")
                {
                    $select = $this->con->query('SELECT  password FROM login WHERE email ="' . $email . '"');
                    if ($select->num_rows == 1)
                    {
                        while ($row = $select->fetch_assoc())
                        {
                            if ($row['password'] == $this->pass)
                            {
                                $this->error_arr[0] = "done";
                                return $this->error_arr;
                            }
                        }
                        //if he come here so he did not find coorect password
                        
                        $this->error_arr[0] = "password";
                        $this->error_arr[1] = "Un Correct Password";
                        return $this->error_arr;

                    }
                }

            }
            else
            {
                $this->error_arr[0] = "email";
                $this->error_arr[1] = "Entered Email Not Founded";
                return $this->error_arr;
            }
        }
        else
        {
            $this->error_arr[0] = "email";
            $this->error_arr[1] = "Un Correct  Email";
            return $this->error_arr;
        }

    }
    private function email_found($email)
    {
        $select = 'SELECT email FROM login WHERE email ="' .$email .'"';

        $res = $this->con->query($select);

        if($res->num_rows == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    private function is_email($email , $last_part)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {

            $arr = explode("@",$email);
            if(count($arr) == 2 && $arr[1] == $last_part)
            {
                return true;
            }
            else
                return false;
        }
        else
            return false;

    }
 
    private function check_pass($pass)
    {
        if(strlen($pass) > strlen(filter_var($pass , FILTER_SANITIZE_STRING)))
        {
            return "tag";
        }
        else if($this->have_space($pass))
        {
            return "names";
        }
        else if(strlen($pass) > strlen($this->con->real_escape_string($pass)))
        {
          return "special";
        }
        else
            return "good";
    }
    private function have_space($string)
    {
        for($i =0 ;$i < strlen($string);$i++)
        {
            if($string[$i] == " ")
                return true;
        }
        return false;
    }
    
    public function get_id($email)
    {
        if($this->is_email($email, "gmail.com") || $this->is_phone_number($email, "yahoo.com"))
        {
            $id_res = $this->con->query('SELECT id FROM signup WHERE email ="' . $email . '"');
            if($id_res->num_rows > 0)
            {
                while($row = $id_res->fetch_assoc())
                    $id  = $row['id'];
            }
        }
        else
            return false;
            
            
            return $id;
    }
    
}
?>
<?php

/*
 *  use of class 
 * 
 *  this page will recive atleast two post variable email and password and optional rem
 *  
 *  rem ==> remmber me
 *  
 *  rem will sent as string variable and if == 'true' will create cookie named id will work for 1 year
 *  
 *  if the login done without problems this page will return 'done'
 *  
 *  but if any problem this page will return problem like this ==>  email:uncorrect email
 *                                                         or  ==> password:uncorrect password
 *                                                         
 *  
 *  
 */
if(isset($_POST['email']) && isset($_POST['password']))
{
    $login = new login("localhost" , "root" , "","project");

    $username = $_POST['email'];
    $password = $_POST['password'];

    
    $output = $login->start_login($username , $password);
    if($output[0] == "done")
    {
        session_start();
        $id = $login->get_id($username);
        
        $_SESSION['id'] = $id;
        
        if(isset($_POST['rem']))
        {
            if($_POST['rem'] == "true")
            {
                //this cookie will work for year
                setcookie('login' , $id , time() + (86400 * 30 * 12) , '/');
            }
            
        }
        

        echo "done";
    }
    else
    {
        echo $output[0] . ":" .$output[1] ;
    }
        
        
}
?>
