<?php


namespace Tanis\Database\Managers;


use Tanis\Database\Connectors\ConnectionFactory;
use Tanis\Models\Model;
use PDO;

class EntityManager
{
    /**
     * @var ConnectionFactory
     */
    public $connectionFactory;

    private $connection;

    public function __construct()
    {
        $this->connectionFactory = new ConnectionFactory();
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        if (!$this->connection) {

            $mysqlConfig = [
                'host' => '172.18.0.3',
                'driver' => 'mysql',
                'username' => 'root',
                'password' => 'root',
                'database' => 'tanis',
            ];

            $this->connection = $this->connectionFactory->createConnector($mysqlConfig)->connect($mysqlConfig);
        }
        return $this->connection;
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
        $j = $this->getConnection()->lastInsertId();
        return $model;
    }

    public function getCategories()
    {
        $stmt = $this->getConnection()->query('SELECT * FROM categories');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryBrands($catId)
    {
        $stmt = $this->getConnection()->prepare('SELECT b.name FROM products
                                                          INNER JOIN brands b on products.brand_id = b.brand_id
                                                          INNER JOIN categories c on products.category_id = c.category_id
                                                          WHERE c.category_id = :category_id
                                                          GROUP BY b.brand_id'
        );
        $stmt->bindParam(':category_id', $catId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}