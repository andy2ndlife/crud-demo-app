<?php

class ManageDatabase {

	protected $db_conn;
	protected $db_host = 'sql3.freemysqlhosting.net';
    protected $db_name = 'sql3276915';
    protected $db_user = 'sql3276915';
    protected $db_pass = 'mpHdpvAhMm';



	function connect(){

		try{

			$this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass);

			return $this->db_conn;

		}

		catch(PDOException $e){

			return $e->getMessage();

		}

	}

}

?>