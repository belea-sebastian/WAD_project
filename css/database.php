<?php

class CreateDB
{
	public $servername;
	public $username;
	public $password;
	public $dbname;
	public $tablename;
	public $con;

	public function __construct($dbname = "products",
        $tablename = "prod",
        $servername = "localhost",
        $username = "root",
        $password = "")
	{
		$this->dbname = $dbname;
		$this->tablename = $tablename;
		$this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        $this->con = mysqli_connect($servername,$username,$password,$dbname);

        if(!$this->con)
        {
        	die("Unable to connect");
        }
	}
    

    public getData($name)
    {
    	$sql = "SELECT * FROM $this->tablename WHERE Poster="$name" ";
    	$result = mysql_query($this->con,$sql);

    	if(mysqli_num_rows($result) > 0)
    	{
    		return $result;
    	}
    }
}

?>
