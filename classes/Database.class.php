<?php  
	// namespace \Classes;
	require "config.php";

	class Database
	{
		private $pdo;

		public function __construct()
		{
			global $config;
			$this->dbname = $config["dbname"];
			$this->dbhost = $config["dbhost"];
			$this->dbuser = $config["dbuser"];
			$this->dbpassword = $config["dbpassword"];
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

		// public function connect()
		// {
		// 	$pdo = new PDO
		// 	(
		// 		'mysql:dbname='.$this->dbname.';host='.$this->dbhost,
		// 		$this->dbuser,
		// 		$this->dbpassword
		// 	);

		// 	$pdo->exec('SET NAMES UTF8');

		// 	$this->pdo = $pdo;

		// 	echo "connexion établie <br>";

		// 	return $pdo;
		// }
	}
?>