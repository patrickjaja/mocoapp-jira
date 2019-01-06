<?php

namespace Pyz\Zed\DataImport\Business\Model;

interface PropelExecutorInterface
{
    /**
     * @param string $sql
     * @param array $parameters
     *
     * @return array|null
     */
    public function execute(string $sql, array $parameters): ?array;
}
