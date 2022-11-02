 <?php

include('connection.php');
if($_POST['token'] == 'as23rlkjadsnlkcj23qkjnfsDKJcnzdfb3353ads54vd3favaeveavgbqaerbVEWDSC')
{
     $user_id = $_POST['user_id'];
     $task_id = $_POST['id'];

    $check_user = "SELECT `id`, `user_id`, `dropoff_location`, `status` FROM `task` WHERE user_id = '$user_id'";
    $exec_user = mysqli_query($conn,$check_user); 
    $num_user = mysqli_num_rows($exec_user);
    if($num_user > 0)
    {
        while($task_id = mysqli_fetch_array($exec_user))
        {
            $t_id = $task_id['id'];
            $dropoff_location = $task_id['dropoff_location'];
            $status = $task_id['status'];
            
            $query = "SELECT `id`, `name`, `pickup_location` FROM `task_details` WHERE task_id = '$t_id'";
            $exec_query  = mysqli_query($conn,$query);
            $rows_count = mysqli_num_rows($exec_query);
            if($rows_count > 0)
            {
                $array = array();  
                 while($row = mysqli_fetch_array($exec_query))
                 {
                    
                     
                     $temp =[
                                    "id"=>$row['id'],
                                    "name"=>$row['name'],
                                    "pickup_location"=>$row['pickup_location'],
                                    "number_of_visiting_places"=>$rows_count,
                                    "dropoff_location"=> $dropoff_location,
                                    "status"=>$status,
                            ];
                            array_push($array,$temp);
                     
                     
                 }
                 
                  $data = ["status"=>true,
                    "message"=>"tasks found successfully.",
                    "data"=>$array,
                    ];
                echo json_encode($data);
                  
         }
         else
         {
                    $data = ["status"=>false,
                    "message"=>"No task found!",
                    // "data"=>[],
                    ];
                    echo json_encode($data); 
          }
                
       }
    }
        
    else
    {
           $data = ["status"=>false,
                        "message"=>"user id not found",
                    ];
           echo json_encode($data); 
    } 
}
else
{
    $data = ["status"=>false,
                "message"=>"Access denied"];
       echo json_encode($data); 
}

?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 