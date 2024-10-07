<?php

namespace RestfulAPI\Models;

use RestfulAPI\Utils\Connection;
use PDO;

/**
 * UserModel class for interacting with the `users` table in the database.
 */
class UserModel extends Connection
{
    /**
     * @var PDO The PDO instance for database connection.
     */
    private $pdo;

    /**
     * @var string The name of the table to be used in the database.
     */
    private $table = 'Users';

    public function __construct()
    {
        parent::__construct();

        $this->pdo = $this->getConnection();
    }

    /**
     * Fetch all records from the database.
     *
     * @return array|string Returns an array of records on success, or an error message string on failure.
     */
    public function fetchAll(): array|string
    {
        $query = 'SELECT * FROM ' . $this->table;

        try {
            $stmt = $this->pdo->query($query);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException) {
            return 'An error occurred fetching all. Please try again later.';
        }
    }

    /**
     * Fetch a record from the database by its ID.
     *
     * @param int $id The ID of the record to fetch.
     *
     * @return array|bool Returns an associative array of the record on success,
     *                    or `false` if no record was found.
     */
    public function fetchById(int $id): array|bool
    {
        $query =
            'SELECT * FROM '
            . $this->table
            . ' WHERE id = :id';

        $stmt = $this->pdo->prepare($query);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Store a new record in the database.
     *
     * @param array $values An associative array containing the values to be inserted into the database.
     *                      The array should have keys matching the column names: 'name', 'email', 'password'.
     *
     * @return array Returns an associative array with the status of the operation.
     */
    public function store(array $values = []): array
    {
        try {
            $query =
                'INSERT INTO '
                . $this->table
                . ' (name, email, password) '
                . ' VALUES (:name, :email, :password)';

            $stmt = $this->pdo->prepare($query);

            $stmt->execute($values);

            return ['success' => true, 'data' => $values];
        } catch (\PDOException $e) {
            return ['success' => false, 'data' => $e->getMessage()];
        }
    }

    /**
     * Updates an existing user in the `users` table.
     *
     * @param int   $id     The ID of the user to update.
     * @param array $values An associative array containing the new user data:
     *                      'name', 'email', and 'password'.
     *
     * @return array
     */
    public function update(int $id, array $values = []): array
    {
        try {
            $query =
                'UPDATE '
                . $this->table
                . ' SET name = :name, email = :email, password = :password'
                . ' WHERE id = :id';

            $data = ['id' => $id] + $values;

            $stmt = $this->pdo->prepare($query);

            $stmt->execute($data);

            return ['success' => true, 'data' => $data];
        } catch (\PDOException $e) {
            return ['success' => false, 'data' => $e->getMessage()];
        }
    }

    /**
     * Deletes a user from the `users` table.
     *
     * @param int $id The ID of the user to delete.
     *
     * @return int The number of affected rows.
     */
    public function destroy(int $id): int
    {
        $query =
            'DELETE FROM '
            . $this->table
            . ' WHERE id = :id';

        $stmt = $this->pdo->prepare($query);

        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
