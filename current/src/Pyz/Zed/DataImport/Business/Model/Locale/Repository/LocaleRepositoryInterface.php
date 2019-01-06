<?php

namespace Pyz\Zed\DataImport\Business\Model\Locale\Repository;

interface LocaleRepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return int
     */
    public function getIdLocaleByLocale($locale);
}
