<?php


namespace Tanis\Database\Connectors;

use Tanis\Database\Connectors\MysqlConnector;

class ConnectionFactory
{
    /**
     * Create a new connection instance.
     *
     * @param  array    $config
     * @return \Tanis\Database\Connection
     *
     * @throws \InvalidArgumentException
     */
    protected function createConnection(array $config = [])
    {
        $pdo = $this->createPdoResolver($config);

        switch ($config['driver']) {
            case 'mysql':
                return new MySqlConnection($pdo, $database, $prefix, $config);
        }

        throw new InvalidArgumentException("Unsupported driver [$driver]");
    }

    /**
     * Create a new Closure that resolves to a PDO instance where there is no configured host.
     *
     * @param  array  $config
     * @return \Closure
     */
    protected function createPdoResolver(array $config)
    {
        return function () use ($config) {
            return $this->createConnector($config)->connect($config);
        };
    }

    /**
     * Create a connector instance based on the configuration.
     *
     * @param  array  $config
     * @return \Tanis\Database\Connectors\ConnectorInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createConnector(array $config)
    {
        if (! isset($config['driver'])) {
            throw new InvalidArgumentException('A driver must be specified.');
        }

        switch ($config['driver']) {
            case 'mysql':
                return new MySqlConnector;
            case 'pgsql':
                return new PostgresConnector;
            case 'sqlite':
                return new SQLiteConnector;
            case 'sqlsrv':
                return new SqlServerConnector;
        }

        throw new InvalidArgumentException("Unsupported driver [{$config['driver']}]");
    }
}