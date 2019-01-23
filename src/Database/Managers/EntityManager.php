<?php


namespace Tanis\Database\Managers;


use Tanis\Database\Connectors\ConnectionFactory;
use Tanis\Models\Model;

class EntityManager
{
    /**
     * @var ConnectionFactory
     */
    public $connectionFactory;

    public function __construct()
    {
        $this->connectionFactory = new ConnectionFactory();
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        $mysqlConfig = [
            'host' => '172.18.0.3',
            'driver' => 'mysql',
            'username' => 'root',
            'password' => 'root',
            'database' => 'tanis',
        ];

        return $this->connectionFactory->createConnector($mysqlConfig)->connect($mysqlConfig);
    }

    /**
     * @param Model $model
     */
    public function insert(Model $model)
    {
        try {
            $stmt = $this->getConnection()->prepare('INSERT INTO ' . $model->getTable() . ' (' . $model->getFields() . ') VALUES (' . $model->getValues() . ')');
            $stmt->execute();
        } catch (\PDOException $e) {
            $ed = $e;
        }
    }
}