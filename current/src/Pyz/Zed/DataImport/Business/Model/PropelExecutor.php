<?php

namespace Pyz\Zed\DataImport\Business\Model;

use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Propel;

class PropelExecutor implements PropelExecutorInterface
{
    /**
     * @param string $sql
     * @param array $parameters
     *
     * @return array|null
     */
    public function execute(string $sql, array $parameters): ?array
    {
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($parameters);

        return $stmt->fetchAll();
    }

    /**
     * @return \Propel\Runtime\Connection\ConnectionInterface
     */
    protected function getConnection(): ConnectionInterface
    {
        return Propel::getConnection();
    }
}
