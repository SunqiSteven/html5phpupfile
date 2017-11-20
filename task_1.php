<?php
//connect to database by using PDO
set_exception_handler(function($e){
	echo $e->getMessage();
});
class Db_service {
	public function __construct(){
		$dsn = 'mysql:dbname=app;host=127.0.0.1';
		$user= 'root';
		$pwd = 'roo';
		$pdo = new PDO($dsn,$user,$pwd);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
			//解决取出的ID是字符的bug
		$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$this->pdo = $pdo;
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
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute($params);
			return $result;
		
	}
	public function insertGetId($sql,$params){
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute($params);
			return (int)$this->pdo->lastInsertId();
	}
}









