<?php


if($_POST['token'] == 'as23rlkjadsnlkcj23qkjnfsDKJcnzdfb3353ads54vd3favaeveavgbqaerbVEWDSC')
{
    include('connection.php');
    $drop = $_POST["drop_location"];
    $menu_item  = $_POST['menu_item'];
    
    $u_id = $_POST['user_id'];
    
    $insert_task = "INSERT INTO `task`(`user_id`, `dropoff_location`) VALUES ('$u_id','$drop')";
    $run_task = mysqli_query($conn,$insert_task);
    $last_id = $conn->insert_id;
    $data= json_decode($menu_item);
 
       
     
    foreach($data as $item)
    {
        $menu_item_id =  $item->menu_item_id;
        $title =  $item->title;
        $name =  $item->name;
        $desc =  $item->description;
        $pickup_location =  $item->pickup_location;
        $estimate_amount =  $item->estimated_cost;
    
        //   print_r($menu_item_id);
       
        $insert = "INSERT INTO `task_details`(`task_id`, `title`, `name`, `description`, `estimated_cost`,`pickup_location`,
        `drop_location`, `menu_item_id`) 
        VALUES ('$last_id','$title','$name','$desc','$estimate_amount','$pickup_location','$drop','$menu_item_id')";
        $run_insert = mysqli_query($conn,$insert);
        
    }
    
    if($run_insert)
    {
        
        $data = ["status"=>true,
                "message"=>"your order has been placed"];
                echo json_encode($data); 
    }
    else
    {
        $data = ["status"=>false,
        "message"=>"failed!"];
        echo json_encode($data);  
    }
        
 
}
else
{
      $data = ["status"=>false,
            "Response_code"=>403,
            "Message"=>"Access denied"];
      echo json_encode($data);   
}
  
  
  
  
  
 ?>



