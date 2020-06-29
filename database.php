<?php

class database
{ 
   private $conn;

	function __construct()
	{  try
		{
           $this->conn = new PDO("mysql:host = localhost;dbname=crud_api","root","");            			
		
           $this->conn->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
        {
        	echo "database connection error ".$e->getMessage();
        } 
           
	}

     public function getAll()
     {
        $data["body"] = [];


        $query = "select * from api_tab";
  
        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();

        //$num = $result->rowCount();
        if($stmt->rowCount() > 0)
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
               extract($row);

               $e = ["id" => $id ,"name" => $name ,"email" => $email ,"password" => $password];

               array_push($data["body"], $e); 
            } 

            return $data;	
        }	
        else
        {
        	return 0;
        }
        return ["message"=>"hello"];
     }

     public function create($name ,$email ,$password)
     {
     	$query = "insert into api_tab(name ,email ,password) values(:name ,:email ,:password)";
        
     	$stmt = $this->conn->prepare($query);

     	$arry = 
     	[
            ":name" => $name,

            ":email" => $email,

            ":password" => $password

     	];

     	if($stmt->execute($arry))
     	{
           return 1;
     	}
     	else
     	{
     		return 0;
     	}

     }

     public function update($id ,$name ,$email ,$password)
     {
     	$query = "update api_tab set name = :name ,email = :email ,password = :password where id = :id";

     	$stmt = $this->conn->prepare($query);

     	$data = 
     	[
     		":name" => $name,
     		":email"=>$email,
     		":password"=>$password,
     		":id"=>$id
        ];

        if($stmt->execute($data))
        {
        	return 1;
        }
        else
        {
        	return 0;
        } 

     } 

     public function delet($id)
     {
     	$query = "delete from api_tab where id =:id";

     	$stmt = $this->conn->prepare($query);

     	$stmt->bindParam(":id" ,$id ,PDO::PARAM_INT);

     	//$result = $stmt->execute();

     	if($stmt->execute())
     	{
     		return 1;
     	}
     	else
     	{
     		return 0;
     	}
     }
}