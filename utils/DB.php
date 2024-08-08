<?php
require_once (ROOT. '/Traits/SingletonTrait.php');

class DB
{
    use SingletonTrait;

	private $pdo;

	private static $instance = null;

	private function __construct()
	{
		$dsn = 'mysql:dbname=phptest;host=127.0.0.1';
		$user = 'root';
		$password = '';

		$this->pdo = new \PDO($dsn, $user, $password);
	}

	public function select($sql, $value = [])
	{
		$sth = $this->pdo->prepare($sql);
        $sth->execute($value);
		return $sth->fetchAll();
	}

	public function exec($sql, $value = [])
	{
		return $this->pdo->prepare($sql)->execute($value);
	}

	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}