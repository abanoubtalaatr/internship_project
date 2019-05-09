<?php 
class task_soluation
{
    public function task_soluation()
    {

    }
    public function correct_this($task_number , $id)
    {
        $task_name = "task_" . $task_number . ".php";
        $path_file = "../tasks/" . $task_name;

        if($task_number == 1)
        {
            $this->task_1_correction($path_file);
        }
        else if($task_number == 2)
        {
            $this->task_2_correction($path_file);
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
        $correct[2] = "kero";
        $correct[3] = "bassem";
        $correct[4] = "namewithoutspace";
        $correct[5] = "namewithouttag";

        $degree = 0;
        for($i=0;$i<count($wrong);$i++)
        {
            if($task->check_name($wrong[$i]) == "wrong" && $task->check_name($correct[$i]) == "correct")
            {
                $degree++;
            }
            else if($task->check_name($wrong[$i]) == "correct" || $task->check_name($correct[$i]) == "wrong")
            {
                continue;
            }
        }

        return $degree;
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
        $correct[3] = "01202873616";
        $correct[4] = "01101287636";
        $correct[5] = "01002873616";

        $degree = 0;
        for($i=0;$i<count($wrong);$i++)
        {
            if($task->check_name($wrong[$i]) == "wrong" && $task->check_name($correct[$i]) == "correct")
            {
                $degree++;
            }
            else if($task->check_name($wrong[$i]) == "correct" || $task->check_name($correct[$i]) == "wrong")
            {
                continue;
            }
        }
        return degree;
    }

}
?>
<?php
    if(isset($_POST['id']) && isset($_POST['task_number']) && isset($_POST['fun']))
    {
        if($_POST['fun'] == "check_task")
        {
            $task = new task_soluation();
            $task->correct_this($_POST['task_number'] , $_POST['id']);
        }
    }
?>
