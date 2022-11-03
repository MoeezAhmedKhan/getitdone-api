<?php


if($_POST['token'] == 'as23rlkjadsnlkcj23qkjnfsDKJcnzdfb3353ads54vd3favaeveavgbqaerbVEWDSC')
{


 $email = $_POST['email'];
 $newpass = $_POST['password'];
 
 include('connection.php');
 
   

    

  if (empty($newpass))
  {
     $data = [
        "status"=>false,
        "message"=>"New password is required",
             ];
         echo json_encode($data); 
  }
  else
  {
      
        $sql="SELECT `id` FROM `users` WHERE `email` = '$email'";
        $execute = mysqli_query($conn,$sql);
            if(mysqli_num_rows($execute) > 0)
            {
                
                $user_data = mysqli_fetch_array($execute);
                $user_id = $user_data['id'];
                $user_update = "UPDATE `users` SET `password` = '$newpass' WHERE `id` = '$user_id'";
                $execute_update = mysqli_query($conn,$user_update);
                
                if($execute_update)
                {
                    
                     $temp = 
                          [
                            "status"=>true,
                            "message"=>"password has been updated",
                          ];
                     echo json_encode($temp);
                    
                
                }
              else
              {
                    
                              $temp = 
                              [
                                "status"=>false,
                                "message"=>"password update failed",
                              ];
                         echo json_encode($temp);
                    
                }
  
        }
  
    }
}
else{
  $data = ["status"=>false,
            "Response_code"=>403,
            "Message"=>"Access denied"];
  echo json_encode($data);          
}
