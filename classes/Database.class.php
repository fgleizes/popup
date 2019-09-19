<?php  
	require "Configuration.class.php";
	
	class Database extends Configuration
	{	
		private $pdo;

		public function __construct()
		{
			$configuration = new Configuration();

			$this->dbname = $configuration->dbname;
			$this->dbhost = $configuration->dbhost;
			$this->dbuser = $configuration->dbuser;
			$this->dbpassword = $configuration->dbpassword;
			
			$this->pdo = new PDO
			(
				'mysql:dbname='.$this->dbname.';host='.$this->dbhost,
				$this->dbuser,
				$this->dbpassword
			);

			$this->pdo->exec('SET NAMES UTF8');
		}

		public function executeSql($sql, array $values = array())
		{
			$query = $this->pdo->prepare($sql);

			$query->execute($values);

			return $this->pdo->lastInsertId();
		}

	    public function query($sql, array $criteria = array())
	    {
	        $query = $this->pdo->prepare($sql);

	        $query->execute($criteria);

	        return $query->fetchAll(PDO::FETCH_ASSOC);
	    }

	    public function queryOne($sql, array $criteria = array())
	    {	
	        $query = $this->pdo->prepare($sql);

	        $query->execute($criteria);

	        return $query->fetch(PDO::FETCH_ASSOC);
		}
	}
?>