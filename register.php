<?php
 include('connection.php');

if($_POST['token'] == 'as23rlkjadsnlkcj23qkjnfsDKJcnzdfb3353ads54vd3favaeveavgbqaerbVEWDSC')
{
    
    $fname= $_POST['first_name'];
    $lname= $_POST['last_name'];
    $phone= $_POST['phone'];
    $email= $_POST['email'];
    $address= $_POST['address'];
    $city= $_POST['city'];
    $state= $_POST['state'];
    $zipcode= $_POST['zipcode'];
    $password = $_POST['password'];
    $notification_token= $_POST['notification_token'];
    $social_id = $_POST['social_id'];
    $role_id = $_POST['role_id'];



if (empty($fname))
{
      
     $data = ["status"=>false,
                "message"=>"First name is required",
             ];
         echo json_encode($data); 
         
}
else if (empty($lname))
{
      
     $data = ["status"=>false,
                "message"=>"Last name is required",
             ];
         echo json_encode($data); 
         
}

else if(empty($email)) 
{
      
    $data = ["status"=>false,
                "message"=>"Email is required",
             ];
         echo json_encode($data);
         
}
else if(empty($phone)) 
{
      
    $data = ["status"=>false,
                "message"=>"Phone is required",
             ];
         echo json_encode($data);
         
}


else if(empty($password)) 
{
      
    $data = ["status"=>false,
                "message"=>"Password is required",
             ];
         echo json_encode($data); 
         
}
else
{
      
    $check_if_dataisin_db="SELECT `id` FROM `users` WHERE `email` = '$email'";
    $execute = mysqli_query($conn,$check_if_dataisin_db);
        
  
    if(mysqli_num_rows($execute) == 0)
    {
            
            
         if(empty($social_id)) 
         {  
                 $insert_user = "INSERT INTO `users`(`first_name`, `last_name`, `phone`, `email`, `password`,
                `address`, `city`, `state`, `zipcode`, `role_id`, `notification_token`) VALUES 
                 ('$fname','$lname','$phone','$email','$password','$address','$city','$state','$zipcode','$role_id','$notification_token')";
                 $result = mysqli_query($conn,$insert_user);
        
             if($result)
             {
            
                    $last_id = $conn->insert_id;
                    $temp = [
                       "user_id"=> $last_id,
                       "fname"=>$fname,
                       "role_id"=>$role_id,
                       "lname"=>$lname,
                       "phone"=>$phone,
                        "email"=> $email,
                        "password"=> $password,
                        "address"=> $address,
                        "city"=> $city,
                        "state"=> $state,
                        "zipcode"=> $zipcode,
                        "notification_token"=> $notification_token,
                        ];
                    
                      $data = ["status"=>true,
                            "message"=>"user has been registered sucessfully.",
                            "data"=>$temp];
                      echo json_encode($data);   
              }
              else
              {
                  
                 $data = ["status"=>false,
                        "message"=>"there was some error"];
                 echo json_encode($data);   
              }
         }
         else
         {
             
                $insert_user = "INSERT INTO `users`(`first_name`, `last_name`, `phone`, `email`, `password`,
                `address`, `city`, `state`, `zipcode`, `role_id`,`social_id` ,`notification_token`) VALUES 
                ('$fname','$lname','$phone','$email','$password','$address','$city','$state','$zipcode','$role_id','$social_id','$notification_token')";
                $result = mysqli_query($conn,$insert_user);
        
                if($result)
                {
                    
                        $last_id = $conn->insert_id;
                        $temp = [
                                   "user_id"=> $last_id,
                                   "fname"=>$fname,
                                   "lname"=>$lname,
                                   "phone"=>$phone,
                                   "role_id"=>$role_id,
                                    "email"=> $email,
                                    "password"=> $password,
                                    "address"=> $address,
                                    "social_id"=>$social_id,
                                    "city"=> $city,
                                    "state"=> $state,
                                    "zipcode"=> $zipcode,
                                    "notification_token"=> $notification_token,
                                ];
                            
                          $data = ["status"=>true,
                                "message"=>"user has been registered sucessfully.",
                                "data"=>$temp];
                          echo json_encode($data);   
                    }
                  else
                  {
                      
                     $data = ["status"=>false,
                            "message"=>"there was some error"];
                     echo json_encode($data);   
                  }
             
         }
    }
    else
    {
      
          $data = ["status"=>false,
                    "message"=>"email already exists"];
          echo json_encode($data);
      
     }
      
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