<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
?>
<?php
<<<<<<< HEAD
session_start();
=======

>>>>>>> efc5e46646472a40343ef6725de0d5d613795d8e
class sign_up
{
    private $con;

    private $fn;
    private $fn_error;

    private $ln;
    private $ln_error;

    private $email;
    private $email_error;

    private $pass;
    private $pass_error;
    
    private $repass;
    private $repass_error;
    

    private $gender;
    private $country;

    private $error_arr = array();

    public function sign_up($server_name , $db_user , $db_pass , $db_name)
    {
        $this->con = new mysqli($server_name , $db_user , $db_pass , $db_name);
    }
    public function start_sign_up($first_name , $last_name , $email, $pass ,$repass , $gender , $country)
    {
        $this->fn = $first_name;
        $this->ln = $last_name;
        $this->pass = $pass;
        $this->repass = $repass;
        $this->gender     = $gender;
        $this->email = $email;
        $this->country = $country;
        //we will allow gmail and yahoo emails and we can allow any email type by add condition on if
        if($this->is_email($this->email,'gmail.com') || $this->is_email($this->email , "yahoo.com"))
        {
            

            if($this->get_first_name_error() == "good" && $this->get_last_name_error() == "good" && $this->get_email_error() == "good" && $this->get_pass_error() == "good" && $this->get_repass_error() == "good")
            {
                //here we will store all user data
                //and we will send to user email that email will have number
                //to know that the email is your email or fake email
                $this->fn = $this->con->real_escape_string($this->fn);
                $this->ln = $this->con->real_escape_string($this->ln);
                $this->email = $this->con->real_escape_string($this->email);
                $this->pass = $this->con->real_escape_string($this->pass);

                //first we will insert data on sign up table
                $insert_sign_up = "INSERT INTO signup (first_name , last_name  , email , password , gender , country) VALUES('".$this->fn."' , '". $this->ln ."' ,'".$this->email."', '".$this->pass."', '".$this->gender."' ,'".$this->country."' )";
                $this->con->query($insert_sign_up);

                //second we will insert some of data on login table
                $insert_login = "INSERT INTO login ( email , password ) VALUES ('".$this->email."' , '".$this->pass."')";
                $this->con->query($insert_login);

                //we will send email to user to sure that is his email
                $code = rand(10000000 , 100000000);
                $this->store_code_into_signup($this->email, $code);
                $html_msg = "<h2>Your Email used to Signup on internship website </h2><h2>please inter this code {{".$code."}} into signup page to complete Signup</h2>";
                $this->send_mail($this->email, $html_msg);
                $this->error_arr[0] = "done";
            }
            else
            {
                $this->fn_error = $this->get_first_name_error();
                $this->ln_error = $this->get_last_name_error();
                $this->email_error = $this->get_email_error();
                $this->pass_error = $this->get_pass_error();
                $this->repass_error = $this->get_repass_error();
                if($this->fn_error != "good")
                {
                    $this->error_arr[0] = "first_name";
                    $this->error_arr[1] = $this->fn_error;
                }
                if($this->ln_error != "good")
                {
                    $this->error_arr[0] = "last_name";
                    $this->error_arr[1] = $this->ln_error;
                }
                if($this->email_error != "good")
                {
                    $this->error_arr[0] = "email";
                    $this->error_arr[1] = $this->email_error;
                }
                if($this->pass_error != "good")
                {
                    $this->error_arr[0] = "password";
                    $this->error_arr[1] = $this->pass_error;
                }
                if($this->repass_error != "good")
                {
                    $this->error_arr[0] = "repassword";
                    $this->error_arr[1] = $this->repass_error;
                }
            }
                

        }
        else
        {
            $this->error_arr[0] = "email";
            $this->error_arr[1] = "Uncorrect Input Write Vaild Email";
        }

        return $this->error_arr;
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
    
    private function get_first_name_error()
    {
        $output = $this->check_name($this->fn);
        if($output === "empty")
        {
            $this->fn_error = "You Should Write Your First Name";
        }
        else if($output === "tag")
        {
            $this->fn_error = "Do Not Write Any Tag Again in Your Name";
        }
        else if($output === "space")
        {
            $this->fn_error = "First Name Should Not start With Space";
        }
        else if($output === "names")
        {
            $this->fn_error = "Just Write One name";
        }
        else if($output === "num")
        {
            $this->fn_error = "You Should Write Your Name Without Numbers";
        }
        else if($output === "good")
        {
            $this->fn_error = "good";
        }
        return $this->fn_error;
    }
    private function get_last_name_error()
    {
        $output = $this->check_name($this->ln);
        if($output === "empty")
        {
            $this->ln_error = "You Should Write Your Last Name";
        }
        else if($output === "tag")
        {
            $this->ln_error = "Do Not Write Any Tag Again in Your Name";
        }
        else if($output === "space")
        {
            $this->ln_error = "Second Name Should Not start With Space";
        }
        else if($output === "names")
        {
            $this->ln_error = "Just Write One name";
        }
        else if($output === "num")
        {
            $this->ln_error = "You Should Write Your Name Without Numbers";
        }
        else if($output === "good")
        {
            $this->ln_error = "good";
        }
        return $this->ln_error;
    }
    private function get_email_error()
    {
        if($this->is_email($this->email, "gmail.com") || $this->is_email($this->email, "yahoo.com"))
        {
            if($this->email_found($this->email) === true)
            {
                $this->email_error = "This Email Used By Another Account";
            }
            else
            {
                $this->email_error = "good";
            }
        }
        else
        {
            $this->email_error = "Un Correct Input Write Vaild Email";
        }
        

        return $this->email_error;
    }
    private function get_pass_error()//here no errors but we want to make sure that the pass is strong
    {
        if(strlen($this->pass) >= 8)
        {
            if($this->have_num($this->pass))
            {
                $this->pass_error = "good";
            }
            else if($this->have_num($this->pass) !== true)
            {
                $this->pass_error = "Put At Least One Number In Your Password";
            }
        }
        else
            $this->pass_error = "Enter 8 Digit At Least In Your Password";

        return $this->pass_error;

    }
    private function get_repass_error()
    {
        if($this->pass == $this->repass)
        {
            $this->repass_error = "good";
        }
        else
        {
            $this->repass_error = "Not Match With Password";
        }
        return $this->repass_error;
    }
    private function check_name($name)
    {
        $l1 = strlen($name);
        $l2 = strlen(filter_var($name , FILTER_SANITIZE_STRING));
        if($name == "")
        {
            return "empty";
        }
        else if($l1 > $l2)//it is meaning the name include tag
        {
            return "tag";
        }
        else if($this->start_with_space($name))
        {
            return "space";
        }
        else if($this->have_space($name))//it is meaning that the name have many words
        {
            return "names";
        }
        else if($this->have_num($name))//it is meaning the the name have a number
        {
            return "num";
        }
        else
            return "good";
    }
    private function start_with_space($name)
    {
        if($name[0] == " ")
            return true;
        else
            return false;
    }
    private function have_space($string)//return false if the name have space
    {
        for($i =0 ;$i < strlen($string);$i++)
        {
            if($string[$i] == " ")
                return true;
        }
        return false;
    }
    private function have_num($name)//return true if the name have num
    {
        for($i=0;$i<strlen($name);$i++)
        {
            if(filter_var($name[$i] , FILTER_VALIDATE_INT))
                return true;
            else
                continue;
        }
        return false;
    }
    public function get_id($email)
    {
        $id = 0;
        if($this->is_email($email, "gmail.com") || $this->is_email($email, "yahoo.com"))
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
    private function store_code_into_signup($email,$code )
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
    public function clear_code_from_signup($email)
    {
        $update = 'UPDATE signup SET code=0 WHERE email="'.$email .'"';
        $this->con->query($update);
    }
    
}
?>
<?php
/*
 * use of class 
 * 
 * this page will recive  varables from any post request and the data will recived if data vaild
 * 
 * the page will return "done" if data vaild 
 * and if not the page will return errors like this ==> first_name:the error
 *                                              or  ==> last_name:the error
 *                                              or  ==> email:the error
 *                                              or  ==> password:the error
 *                                              or  ==> repassword:the error
 *                               
 *                                              
 * this page programmed to display first error he found
 * 
 * by this sort first_name , last_name , email , password , confirm_password
 *
 */
$sign_up = new sign_up("localhost" , "root" , "" , "project");
    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])  && isset($_POST['gender']) && isset($_POST['country']))
    {
        
        //$birthday = $_POST['year'] . "-" .$_POST['month'] . "-" . $_POST['day'];
        $username = $_POST['email'];

        

        
        $output =  $sign_up->start_sign_up($_POST['first_name'] , $_POST['last_name'] , $username , $_POST['password'] ,$_POST['confirm_password'] , $_POST['gender'] , $_POST['country']);
        if($output[0] == "done")
        {
            
            $id = $sign_up->get_id($username);
            $_SESSION['id'] = $id;
            //this cookie will work for year
            //setcookie('login' , $id , time() + (86400 * 30 * 12) , '/');
            echo "done";
        }
        else
        {
            echo  $output[0] . ":" . $output[1];
        }
            
    }
    /*
     * if you send code and email and fun == check_code so you want check the code that we sent it to user on email 
     * to ensure that he write his email
     * 
     * if the code right so this page will return done
     * 
     * if not will return wrong code
     * 
     * if the code on database == 0 so we do not send any email to him so it maybe hacker and try hack us
     * 
     * so this page will return curious
     */
    if(isset($_POST['code']) && isset($_POST['email']) && isset($_POST['fun']))
    {
        if($_POST['fun'] == "check_code")
        {
            $code = $sign_up->get_code_from_signup($_POST['email']);
            
            if($code != 0)
            {
                if($code == $_POST['code'])
                {
                    echo "done";
                    $sign_up->clear_code_from_signup($_POST['email']);
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
?>
