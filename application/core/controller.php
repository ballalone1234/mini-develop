<?php

declare(strict_types=1);

class Controller
{
    /**
     * @var PDO|null Database Connection
     */
    public ?PDO $db = null;

    /**
     * @var Model|null Model
     */
    public ?Model $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    public function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection(): void
    {
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ];

        $this->db = new PDO(
            DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
            DB_USER,
            DB_PASS,
            $options
        );
    }

    /**
     * Loads the "model".
     */
    public function loadModel(): void
    {
        require APP . 'model/model.php';
        $this->model = new Model($this->db);
    }
}
