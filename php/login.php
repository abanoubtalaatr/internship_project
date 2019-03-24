<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
?>
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
                if ($this->check_pass($this->pass) == "done")//if pass just number and chars
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
            return "done";
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
    public function send_mail($email , $htmlmsg){
        
        
        $mail = new PHPMailer();
        
        //Enable SMTP debugging.
        $mail->SMTPDebug = 0;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        // //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        // //Provide username and password
        $mail->Username = "abanoubtalaat50@gmail.com";
        $mail->Password = "rzbkzfriedbwfyfp";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "ssl";
        // //Set TCP port to connect to
        $mail->Port = 465;
        
        $mail->From = 'intershipc@gmail.com';//company
        $mail->FromName = 'intership company';
        
        $mail->addAddress($email, 'abanoub');
        $mail->AddReplyTo('intershipc@gmail.com','intership');
        $mail->isHTML(true);
        
        $mail->Subject ='signup';
        $mail->Body = $htmlmsg;
        
        $mail->send();
        
    }
    public function store_code_into_signup($email,$code )
    {
        $update = 'UPDATE signup SET code =' .$code . ' WHERE email="'.$email .'"';
        $this->con->query($update);
    }
    public function get_code_from_signup($email)
    {
        $select = "SELECT code FROM signup WHERE email='" .$email ."'";
        $res = $this->con->query($select);
        
        if($res->num_rows ==1)
        {
            while($row = $res->fetch_assoc())
            {
                return $row['code'];
            }
        }
    }
    public function reset_password($email , $new_password)
    {
        if($this->check_pass($new_password) == "done")
        {
            $update1 = 'UPDATE signup SET password="' . $new_password . '" WHERE email ="' .$email.'"';
            $update2 = 'UPDATE login SET password="' . $new_password . '" WHERE email ="' .$email.'"';
            $update3 = 'UPDATE signup SET code=0 WHERE email ="' .$email.'"';
            
            $this->con->query($update1);
            $this->con->query($update2);
            $this->con->query($update3);
            
            return "done";
            
        }
        else
        {
            return $this->check_pass($new_password);
        }
    }
    public function clear_code_from_signup($email)
    {
        $update = 'UPDATE signup SET code=0 WHERE email="'.$email .'"';
        $this->con->query($update);
    }
    
    private function get_pass_error($pass)//here no errors but we want to make sure that the pass is strong
    {
        if(strlen($pass) >= 8)
        {
            if($this->have_num($pass))
            {
                return "done";
            }
            else if($this->have_num($this->pass) !== true)
            {
                return  "Put At Least One Number In Your Password";
            }
        }
        else
            return "Enter 8 Digit At Least In Your Password";
            
           
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
$login = new login("localhost" , "root" , "","project");

/*
 * 
 * if you send request to this page and send email and password so you want do validation
 * and login on website
 */
if(isset($_POST['email']) && isset($_POST['password']))
{
   

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
/*
 * if you send email and fun variables and fun == send_code so you want send email when user forget password
 * 
 * and this page will not send any response text
 */
else if(isset($_POST['email']) && isset($_POST['fun']))
{
   
    if($_POST['fun'] == "send_code")
    {
       
        $code = rand(10000000 , 100000000);
        
        $login->store_code_into_signup($_POST['email'], $code);
        
        $htmlmsg = "<h2>hello</h2><h2>your email used to change your password on intership website  </h2><h2>Enter this code { ".$code." } on <a href='#'>Reset Password Page</a></h2>";
        
        $login->send_mail($_POST['email'], $htmlmsg);
        
        
    }
}
/*
 * if you send email and code and fun vaiables and fun == check_code so you want to check if code right or not 
 * 
 * so if right this page will send done
 * 
 * and if wrong this page will return Wrong Code
 */
else if(isset($_POST['email']) && isset($_POST['code']) && isset($_POST['fun']))
{
    if($_POST['fun'] == "check_code")
    {
        $code = $login->get_code_from_signup($_POST['email']);
        
        if($code != 0)
        {
            if($code == $_POST['code'])
            {
                echo "done";
                $login->clear_code_from_signup($_POST['email']);
            }
            else
                echo "Wrong Code";
        }
        else
        {
            echo "curious";
        }
       
    }
}
/*
 * if you send email and new_password and fun == change_password so you want change password 
 * 
 * this page will return done if the password strong 
 * 
 * and if the password week this page will return the error on new_password
 */
else if(isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['fun']))
{
    if($_POST['fun'] == "change_password")
    {
        $response = $login->reset_password($_POST['email'], $_POST['new_password']);
        if($response == "done")
        {
            echo "done";
        }
        else
        {
            echo $response;
        }
    }
}
?>
