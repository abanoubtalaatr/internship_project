<?php 
class task_soluation
{
    private $user_id;
    public function task_soluation($user_id , $task_number)
    {
        $this->user_id = $user_id;
    }
    /*
     * this first task
     * the task :: class named task and contain function named check_name and have one  paramter named name
     *  return true if name length >= 3 and <=20 
     *                 name do not have a number 
     *                 name do not have any space
     *                            
     *  return false if any thing 
     */
    public function name_task()
    {
        require_once 'tasks/task_1.php';
        $task = new task();
        
        if($task->check_name("al") == true || $task->check_name("nnmmbnbnbnjkhgfrtyhma") == true || $task->check_name("bassen34") == true || $task->check_name("bass em")==true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>