<?php

include_once 'database.php';

class user_api
{
	private $db;
    
    function __construct(database $db)
    {
    	$this->db = $db;
    }

    private function encPass($pass)
    {
       $tempPass = "#";  

    	$len = strlen($pass);
        
        $i = 0;
        
        while($len > $i)
        {
        	if($i <= 2)
        	{
        		$tempPass .= "@".$pass[$i]; 
        	}
        	else if(($i > 3) || ($i < 8))
        	{
               $tempPass .= "&".$pass[$i];      
        	}

        	++$i;	
        }
               
        $pass = $tempPass;

        return $pass;
    }

    private function decPass()
    {

    }

	public function create($name,$email,$password)
	{
        $password = $this->encPass($password);

        $res = $this->db->create($name ,$email ,$password);

        return $res;  
	}

	public function getAll()
	{
       $data = $this->db->getAll();

       return $data; 
	}

	public function read($id)
	{

	}

	public function update($id,$name,$email,$password)
	{
       $password = $this->encPass($password); 

       $data = $this->db->update($id,$name,$email,$password);

       return $data;
	}	

	public function delet($id)
	{
       $data = $this->db->delet($id);

       return $data; 
	}

}