<?php
class DB
{
    use SingletonTrait;

	private object $pdo;

	private function __construct()
	{
        $dbConnection = getenv('DB_CONNECTION');
        $dbName = getenv('DB_DATABASE');
        $dbHost = getenv('DB_HOST');

		$dsn = "$dbConnection:dbname=$dbName;host=$dbHost";
        $user = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

		$this->pdo = new \PDO($dsn, $user, $password);
	}

    /**
     * Select for list generation
     * @param $sql
     * @param array $value
     * @return array|false
     */
	public function select($sql, $value = [])
	{
		$sth = $this->pdo->prepare($sql);
        $sth->execute($value);
		return $sth->fetchAll();
	}

    /**
     * For query execution
     * @param $sql
     * @param array $value
     * @return bool
     */
	public function exec($sql, $value = [])
	{
		return $this->pdo->prepare($sql)->execute($value);
	}

    /**
     * Retrieving the latest id produced by DB
     * @return string
     */

	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}