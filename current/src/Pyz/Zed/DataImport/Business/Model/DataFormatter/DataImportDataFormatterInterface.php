<?php

namespace Pyz\Zed\DataImport\Business\Model\DataFormatter;

interface DataImportDataFormatterInterface
{
    /**
     * @param string $value
     * @param string $replace
     *
     * @return string
     */
    public function replaceDoubleQuotes(string $value, string $replace = ''): string;

    /**
     * @param array $values
     *
     * @return string
     */
    public function formatPostgresArray(array $values): string;

    /**
     * @param array $values
     *
     * @return string
     */
    public function formatPostgresArrayString(array $values): string;

    /**
     * @param array $values
     *
     * @return string
     */
    public function formatPostgresArrayFromJson(array $values): string;

    /**
     * @param array $collection
     * @param string $key
     *
     * @return array
     */
    public function getCollectionDataByKey(array $collection, string $key);
}
