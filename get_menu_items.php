<?php
include('connection.php');

$mData = array();

if($_POST['token'] == 'as23rlkjadsnlkcj23qkjnfsDKJcnzdfb3353ads54vd3favaeveavgbqaerbVEWDSC'){

     $sql = "SELECT * FROM `menu_items`";
     
     $execute = mysqli_query($conn,$sql);
     if(mysqli_num_rows($execute) > 0){
         while($row = mysqli_fetch_array($execute)){
             
             $temp =[
                 
                        "id"=>$row['id'],
                         "icon_name"=>$row['icon_name'],
                          "icon_type"=>$row['icon_type'],
                           "title"=>$row['title'],
                    ];
                    
                    array_push($mData,$temp);
        
        }
        $data = ["status"=>true,
            "message"=>"Menu Items fetched successfully",
            "data"=>$mData,
            ];
        echo json_encode($data);  
        // echo 1;
     }else{
          $data = ["status"=>false,
            "message"=>"No data found!"];
             echo json_encode($data);   
     }
     





}else{
  $data = ["status"=>false,
            "Response_code"=>403,
            "Message"=>"Access denied"];
  echo json_encode($data);          
}
  
  
  
  
 ?>