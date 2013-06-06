<?php
	
	require_once("Rest.inc.php");
	
	class API extends REST {
	
		public $data = "";
		
		const DB_SERVER = "localhost";
		const DB_USER = "root";
		const DB_PASSWORD = "";
		const DB = "repository";
		
		private $db = NULL;
	
		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();					// Initiate Database connection
		}
		
		/*
		 *  Database connection 
		*/
		private function dbConnect(){
			$this->db = mysql_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD);
			if($this->db)
				mysql_select_db(self::DB,$this->db);
		}
		
		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);				// If the method not exist with in this class, response would be "Page not found".
		}
		 
		 private function login(){
            if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
            $username=$_GET['username'];
			$password=$_GET['password'];
			
			if(!empty($username) and !empty($password)){
				$sql = mysql_query("SELECT id, username, studentMail FROM user WHERE username = '$username' AND password = '".md5($password)."' LIMIT 1", $this->db);
				if(mysql_num_rows($sql) > 0){
					$result = mysql_fetch_array($sql,MYSQL_ASSOC);
					
					// If success everythig is good send header as "OK" and user details
					$this->response($this->json($result), 200);
				}else{
					$error = array('status' => "failed", "msg" => "Invalid Username or Password");
					$this->response($this->json($error), 200);
				}
				$this->response('', 204);	// If no records "No Content" status
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
        }
		
		public function register(){
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$student	= $_GET['student'];
            $username	= $_GET['username'];
			$password	= $_GET['password'];
			$phone		= $_GET['phone'];
			$email		= $_GET['email'];
			if(!empty($student) and !empty($username) and !empty($password) and !empty($phone) and !empty($email)){
                mysql_query(("INSERT INTO m001_user (id,username,password,studentMail,phone,email)
                                    VALUES ('','$username','$password','$student', '$phone','$email')"),$this->db);
				//benerin query nya. required html page. field harus dimasukin semua walaupun kosong

                    // If success everythig is good send header as "OK" and m001_user details
					$data = array('blablabla' => "data yang diinsert masukin disini");
                   
					$status = array('status' => "success", "msg" => "Register Success", "data" => $data);
					$this->response($this->json($status), 200);
            }
		}

		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}
	
	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>