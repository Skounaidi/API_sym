<?php


namespace App\Service;

class DatabaseService
{
    private string $dbHost;
    private string $dbUser;
    private string $dbPassword;

    public function __construct(string $dbHost, string $dbUser, string $dbPassword)
    {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
    }

    public function getConnection(): \PDO
    {
        $dsn = "mysql:host={$this->dbHost};dbname=api_db;charset=utf8";
        return new \PDO($dsn, $this->dbUser, $this->dbPassword);
    }
}