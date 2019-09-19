<?php 
    class Configuration
    {
        /*
        * Database configuration settings used by PDO.
        */
        
        protected $dbname;
        protected $dbhost;
        protected $dbuser;
        protected $dbpassword;
    
        public function __construct()
        {   
			if ($_SERVER["HTTP_HOST"] === "localhost:8888" ) {
			// Herbergement Local
			$this->dbname = "dbPopup";
			$this->dbhost = "localhost";
			$this->dbuser = "";
			$this->dbpassword = "";
			} else {
			// Herbergement distant
			$this->dbname = "";
			$this->dbhost = "";
			$this->dbuser = "";
			$this->dbpassword = "";
			}
        }
    }
?>