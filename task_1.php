<?php
//connect to database by using PDO
class Db_service {
	public function __construct(){
		$dsn = 'mysql:dbname=app;host=127.0.0.1';
		$user= 'root';
		$pwd = 'root';
		try{
			$pdo = new PDO($dsn,$user,$pwd);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
			//解决取出的ID是字符的bug
			$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->pdo = $pdo;
		}catch(Exception $e){
			exit($e->getMessage());
		}
	}
	public static function getInstance(){
		return (new Db_service());
	}
	public function query($sql,$params){
		$stmt = $this->pdo->prepare($sql);
		$result = $stmt->execute($params);
		if ($result) {
			return $stmt->fetch();
		} else {
			return false;
		}
	}
	public function execute($sql,$params){
		try{
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute($params);
			// var_dump($stmt->errorinfo());
			// return (int)$this->pdo->lastInsertId();
			return $result;
		}catch(Exception $e){
			return false;
		}
		
	}
	public function insertGetId($sql,$params){
		try{
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute($params);
			// var_dump($stmt->errorinfo());
			return (int)$this->pdo->lastInsertId();
			// return $result;
		}catch(Exception $e){
			return false;
		}
	}
}

// $r = Db_service::getInstance()->execute('update account set username=? where id=?',['22',2]);
// var_dump($r);








