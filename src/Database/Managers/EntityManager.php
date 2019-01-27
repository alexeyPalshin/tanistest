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
                'host' => '172.18.0.2',
                'driver' => 'mysql',
                'username' => 'root',
                'password' => 'root',
                'database' => 'tanis',
            ];

            $this->connection = $this->connectionFactory->createConnector($mysqlConfig)->connect($mysqlConfig);
        }
        return $this->connection;
    }

    public function getItem(Model $model, $itemId)
    {
        try {
            $stmt = $this->getConnection()->prepare('SELECT * FROM ' . $model->getTable() . ' WHERE item_id=?');
            $stmt->execute([intval($itemId)]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            var_dump($e);
        }
    }

    /**
     * @param Model $model
     * @return Model
     */
    public function insert(Model $model)
    {
        try {
            $stmt = $this->getConnection()->prepare('INSERT INTO ' . $model->getTable() . ' (' . $model->getFields() . ') VALUES (' . $model->getValues() . ')');
            $stmt->execute();
        } catch (\PDOException $e) {

        }

        return $this->getItem($model, $this->getConnection()->lastInsertId());
    }

    public function delete($table, $itemId)
    {
        try {
            $stmt = $this->getConnection()->prepare('DELETE FROM ' . $table . ' WHERE item_id=?');
            $stmt->execute([intval($itemId)]);
        } catch (\PDOException $e) {
            var_dump($e);
        }
    }

    public function getCategories()
    {
        $stmt = $this->getConnection()->query('SELECT * FROM categories');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryBrands($catId)
    {
        $stmt = $this->getConnection()->prepare('SELECT b.* FROM products
                                                          INNER JOIN brands b on products.brand_id = b.item_id
                                                          INNER JOIN categories c on products.category_id = c.item_id
                                                          WHERE c.item_id=?
                                                          GROUP BY b.item_id'
        );
        $stmt->execute([intval($catId)]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBrandProducts($id)
    {
        $stmt = $this->getConnection()->prepare('SELECT * FROM products WHERE brand_id=?'
        );
        $stmt->execute([intval($id)]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}