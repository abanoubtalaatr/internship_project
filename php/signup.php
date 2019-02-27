<?php

class sign_up
{
    private $con;

    private $fn;
    private $fn_error;

    private $ln;
    private $ln_error;

    private $phone;
    private $email;
    private $username_error;

    private $pass;
    private $pass_error;
    private $birthday;

    private $sex;

    private $error_arr = array();

    public function sign_up($server_name , $db_user , $db_pass , $db_name)
    {
        $this->con = new mysqli($server_name , $db_user , $db_pass , $db_name);
    }
    public function start_sign_up($first_name , $last_name , $email, $pass , $birthday , $sex)
    {
        $this->fn = $first_name;
        $this->ln = $last_name;
        $this->pass = $pass;
        $this->birthday = $birthday;
        $this->sex     = $sex;
        $this->email = $email;
        //we will allow gmail and yahoo emails and we can allow any email type by add condition on if
        if($this->is_email($this->email,'gmail.com') || $this->is_email($this->email , "yahoo.com"))
        {
            

            if($this->get_first_name_error() == "good" && $this->get_last_name_error() == "good" && $this->get_email_error() == "good" && $this->get_pass_error() == "good")
            {
                //here we will store all user data
                //and we will send to user email that email will have number
                //to know that the email is your email or fake email
                $this->fn = $this->con->real_escape_string($this->fn);
                $this->ln = $this->con->real_escape_string($this->ln);
                $this->email = $this->con->real_escape_string($this->email);
                $this->pass = $this->con->real_escape_string($this->pass);

                //first we will insert data on sign up table
                $insert_sign_up = "INSERT INTO signup (first_name , last_name  , email , birthday , sex , password) VALUES('".$this->fn."' , '". $this->ln ."' ,'".$this->email."', '".$this->birthday."', '".$this->sex."' ,'".$this->pass."' )";
                $this->con->query($insert_sign_up);

                //second we will insert some of data on login table
                $insert_login = "INSERT INTO login ( email , password ) VALUES ('".$this->email."' , '".$this->pass."')";
                $this->con->query($insert_login);

                $this->error_arr[0] = "done";
                return $this->error_arr;
            }
            else
                $this->error_arr[0] = "error1";

        }
        else
        {
            $this->error_arr[0] = "error2";
        }

        if($this->error_arr[0] == "error1" || $this->error_arr[0] == "error2")
        {
            if($this->fn_error != "good")
            {
                $this->error_arr[0] = "first_name";
                $this->error_arr[1] = $this->fn_error;
                return $this->error_arr;
            }
            if($this->ln_error != "good")
            {
                $this->error_arr[0] = "last_name";
                $this->error_arr[1] = $this->ln_error;
                return $this->error_arr;
            }
            if($this->username_error != "good")
            {
                $this->error_arr[0] = "email";
                $this->error_arr[1] = $this->username_error;
                return $this->error_arr;
                
            }
            if($this->pass_error != "good")
            {
                $this->error_arr[0] = "password";
                $this->error_arr[1] = $this->pass_error;
                return $this->error_arr;
            }
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
    public function is_email($email , $last_part)
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
    
    public function get_first_name_error()
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
    public function get_last_name_error()
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
    public function get_email_error()
    {
        if($this->email_found($this->email) === true)
        {
            $this->username_error = "This Email Used By Another Account";
        }
        else
        {
            $this->username_error = "good";
        }

        return $this->username_error;
    }
    public function get_pass_error()//here no errors but we want to make sure that the pass is strong
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
        if($this->is_email($email, "gmail.com") || $this->is_phone_number($email, "yahoo.com"))
        {
            $id_res = $this->con->query('SELECT id FROM login WHERE email ="' . $email . '"');
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
 * use of class 
 * 
 * this page will recive  varables from any post request and the data will recived if data vaild
 * 
 * the page will return "done" if data vaild 
 * and if not the page will return errors like this ==> first_name:the error
 *                                              or  ==> last_name:the error
 *                                              
 * this page programmed to display first error he found
 * 
 * by this sort first_name , last_name , email , password
 *
 */
    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['year'])  && isset($_POST['month'])  && isset($_POST['day']) && isset($_POST['sex']))
    {
        $birthday = $_POST['year'] . "-" .$_POST['month'] . "-" . $_POST['day'];
        $username = $_POST['email'];

        $sign_up = new sign_up("localhost" , "root" , "" , "project");

        
        $output =  $sign_up->start_sign_up($_POST['first_name'] , $_POST['last_name'] , $username , $_POST['password'] ,$birthday  , $_POST['sex']);
        if($output[0] == "done")
        {
            session_start();
            $id = $sign_up->get_id($username);
            $_SESSION['id'] = $id;
            //this cookie will work for year
            //setcookie('login' , $id , time() + (86400 * 30 * 12) , '/');
            echo "done";
        }
        else
            echo  $output[0] . ":" . $output[1];
    }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="first_name" placeholder="first name">
	<input type="text" name="last_name" placeholder="last name"><br>
	<input type="text" name="email" placeholder="email"><br>
	<input type="text" name="password" placeholder="password"><br>
	<input type="text" name="year" placeholder="year">
	<input type="text" name="month" placeholder="month">
	<input type="text" name="day" placeholder="day"><br>
	<input type="text" name="sex" placeholder="six"><br><br>
	<input type="submit" value="check">
</form>
