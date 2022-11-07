 <?php

include('connection.php');
if($_POST['token'] == 'as23rlkjadsnlkcj23qkjnfsDKJcnzdfb3353ads54vd3favaeveavgbqaerbVEWDSC')
{
     $user_id = $_POST['user_id'];
     $status = $_POST['status'];
     
     
     if($status == 'completed')
     {
         $sql1 = "SELECT `id`, `user_id`, `dropoff_location`, `status` FROM `task` WHERE user_id = '$user_id' and status = 'completed'";
         $exec1 = mysqli_query($conn,$sql1);
         $rows1 = mysqli_num_rows($exec1);
         if($rows1 > 0)
         {
             $arrmain1 = array();
             while($arr1 = mysqli_fetch_array($exec1))
             {
                 $t_id = $arr1['id'];
                 
                 $sql2 = "SELECT `id`, `task_id`, `title`, `name`, `description`, `estimated_cost`, `pickup_location`, `menu_item_id` FROM `task_details` WHERE task_id = '$t_id'";
                 $exec2 = mysqli_query($conn,$sql2);
                 $rows2 = mysqli_num_rows($exec2);
                 if($rows2 > 0)
                 {
                     $arrmain2 = array();
                     while($arr2 = mysqli_fetch_array($exec2))
                     {
                         $tmp2 = 
                         [
                             "title"=>$arr2['title'],
                             "name"=>$arr2['name'],
                             "description"=>$arr2['description'],
                             "estimated_cost"=>$arr2['estimated_cost'],
                             "pickup_location"=>$arr2['pickup_location'],
                             "menu_item_id"=>$arr2['menu_item_id'],
                         ];
                         array_push($arrmain2,$tmp2);
                     }
                 }
                 
                 
                 $tmp1 = 
                 [
                     "id"=>$arr1['id'],
                     "user_id"=>$arr1['user_id'],
                     "dropoff_location"=>$arr1['dropoff_location'],
                     "status"=>$arr1['status'],
                     "task_details_data"=>$arrmain2,
                 ];
                 array_push($arrmain1,$tmp1);
             }
             
              $data = ["status"=>true,
                "message"=>"Record Found Successfully",
                "data"=>$arrmain1,
                ];
            echo json_encode($data); 
         }
     }
     else
     {
        
         $sql1 = "SELECT `id`, `user_id`, `dropoff_location`, `status` FROM `task` WHERE user_id = '$user_id' and status != 'completed'";
         $exec1 = mysqli_query($conn,$sql1);
         $rows1 = mysqli_num_rows($exec1);
         if($rows1 > 0)
         {
             $arrmain1 = array();
             while($arr1 = mysqli_fetch_array($exec1))
             {
                 $t_id = $arr1['id'];
                 
                 $sql2 = "SELECT `id`, `task_id`, `title`, `name`, `description`, `estimated_cost`, `pickup_location`, `menu_item_id` FROM `task_details` WHERE task_id = '$t_id'";
                 $exec2 = mysqli_query($conn,$sql2);
                 $rows2 = mysqli_num_rows($exec2);
                 if($rows2 > 0)
                 {
                     $arrmain2 = array();
                     while($arr2 = mysqli_fetch_array($exec2))
                     {
                         $tmp2 = 
                         [
                             "title"=>$arr2['title'],
                             "name"=>$arr2['name'],
                             "description"=>$arr2['description'],
                             "estimated_cost"=>$arr2['estimated_cost'],
                             "pickup_location"=>$arr2['pickup_location'],
                             "menu_item_id"=>$arr2['menu_item_id'],
                         ];
                         array_push($arrmain2,$tmp2);
                     }
                 }
                 
                 
                 $tmp1 = 
                 [
                     "id"=>$arr1['id'],
                     "user_id"=>$arr1['user_id'],
                     "dropoff_location"=>$arr1['dropoff_location'],
                     "status"=>$arr1['status'],
                     "task_details_data"=>$arrmain2,
                 ];
                 array_push($arrmain1,$tmp1);
             }
             
              $data = ["status"=>true,
                "message"=>"Record Found Successfully",
                "data"=>$arrmain1,
                ];
            echo json_encode($data); 
         }
         
     }

}
else
{
    $data = ["status"=>false,
                "message"=>"Access denied"];
       echo json_encode($data); 
}

?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 