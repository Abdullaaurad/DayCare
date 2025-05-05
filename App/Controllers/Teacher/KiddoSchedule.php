<?php

    namespace Controller;

    class KiddoSchedule{
        use MainController;
        public function addTask() {
            $task = new \Modal\Activity;
        
            $dateTime = date('Y-m-d H:i:s');
            $data['Date'] = $dateTime;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $arr = $_POST;

                if ($task->validate($arr)) {
                
                    $task->insert($arr);
                    // Redirect to success page or display a success message
                    redirect('Teacher/Dashboard');
                } else {
                    redirect('Teacher/Dashboard');
                   ;
                }
                
            }
           
        
           
        }
    
        public function delete($taskId = null) {
           
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ActivityID'])) {
                
                $task = new \Modal\Activity;

                $taskId = $_POST['ActivityID'];
                // var_dump($taskId);
                // exit();
                
        
                if ($task->deleteTask($taskId)) {
                    echo "<script>alert('Task deleted successfully.'); </script>";
                    redirect('Teacher/Dashboard'); // Redirect to dashboard
                    
                } else {
                    // Optionally, set a message for failure and redirect
                    redirect('Teacher/Dashboard');
                    echo "<script>alert('Task deleted successfully.'); </script>";
                }
            } else {
                // Redirect if accessed via GET or without proper data
                redirect('Teacher/Dashboard');
            }
            // Pass message to the view
            
        }
    
    
       public function updateTask(){
    
        IF($_SERVER['REQUEST_METHOD'] == 'POST'){

            $task = new \Modal\Activity;

            if(empty($_POST['Description'])){
                $_SESSION['error'] = "Invalid data.";
                echo "<script>alert('Failed to update the task.'); </script>";
            }else{
        
                $_SESSION['error'] = null;
                
                $result = $task->update_withid($_POST['ActivityID'], array_slice($_POST,1), 'ActivityID');

            }

            if($result){
                redirect('Teacher/Dashboard');
            }else{
                echo "<script>alert('Failed to update the task.');</script>";
                 redirect('Teacher/Dashboard');
            }
           
            
        } 
    

    
        
    }

//     public function deleteTask($id, $id_column = 'id') {
//         $data[$id_column] = $id;
//         $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";

//         var_dump($query);
//         exit();

//         // Execute the query and check the result
//         $result = $this->query($query, $data);

//         // Return true if rows were affected, otherwise false
//         return $result ? true : false;
// }

    }
?>