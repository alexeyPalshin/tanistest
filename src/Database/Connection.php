<?php


namespace Tanis\Database;


class Connection implements ConnectionInterface
{
    /**
     * The active PDO connection.
     *
     * @var \PDO|\Closure
     */
    protected $pdo;

    /**
     * The name of the connected database.
     *
     * @var string
     */
    protected $database;

    /**
     * The database connection configuration options.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Create a new database connection instance.
     *
     * @param  \PDO|\Closure     $pdo
     * @param  string   $database
     * @param  array    $config
     * @return void
     */
    public function __construct($pdo, $database = '', array $config = [])
    {
        $this->pdo = $pdo;
        $this->database = $database;
        $this->config = $config;

    }
}