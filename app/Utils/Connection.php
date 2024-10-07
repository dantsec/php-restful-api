<?php

namespace RestfulAPI\Utils;

use PDO;

class Connection
{
    /**
     * @var PDO $connection The PDO instance for the database connection.
     */
    private PDO $connection;

    function __construct()
    {
        $this->setConnection();
    }

    /**
     * Get connection from our DB.
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * Set connection to $connection variable.
     *
     * @throws PDOException
     * @return void
     */
    private function setConnection(): void
    {
        try {
            $this->connection = new PDO(
                'mysql:dbname=' . Env::get('DB_NAME') . ';host=' . Env::get('DB_HOST') . ';port=' . Env::get('DB_PORT'),
                Env::get('DB_USER'),
                Env::get('DB_PASS'),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => true
                ]
            );
        } catch(\PDOException $e) {
            throw new \Exception('[ERROR] MYSQL: ' . $e->getMessage());
        }
    }
}
