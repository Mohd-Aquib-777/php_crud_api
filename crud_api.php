<?php
include_once 'ctrl_api.php';

 header("Access-Control-Allow-Origin: *");
 
 header("Content-Type: application/json; charset=UTF-8");

$ctrl = new user_api(new database());

if($_SERVER['REQUEST_METHOD'] == "GET")
{
  $data = $ctrl->getAll();
  if($data)
  {
    
    echo json_encode($data);

    http_response_code(200);	
  } 
  else
  {

     echo json_encode(["message" => "empty table"]);

     http_response_code(502);
  }
 
}

else if($_SERVER["REQUEST_METHOD"] == "POST")
{

  $js = json_decode(file_get_contents("php://input"),true);
  
  extract($js);	
  
  $data = $ctrl->create($name,$email,$password);
   
   if($data)
   {
   	 echo json_encode("data successfully inserted");
     
     http_response_code(201); 	
   }
   else
   {
   	  echo json_encode("data not inserted");

   	  http_response_code(203);
   } 
  
}

else if($_SERVER["REQUEST_METHOD"] == "PUT")
{
    $js = json_decode(file_get_contents("php://input"),true);
    
    extract($js);

    $data = $ctrl->update($id ,$name ,$email ,$password);

    if($data)
    {
    	echo json_encode(["message" => "tupple is updated successfully"]);

    	http_response_code(200);
    }
    else
    {
        echo json_encode(["message" => "tuuple is not updated  successfully"]);

    	http_response_code(402);	
    }
}

else if($_SERVER["REQUEST_METHOD"]== "DELETE")
{
    $js = json_decode(file_get_contents("php://input"),true);
      
    extract($js);  
    
    $data = $ctrl->delet($id);

    if($data)
    {
    	echo json_encode(["message" => "table of specific Id is deleted"]);

    	http_response_code(200);
    }
    else
    {
    	echo json_encode(["message" => "table of specific Id is not deleted"]);

    	http_response_code(500);
    }	

}