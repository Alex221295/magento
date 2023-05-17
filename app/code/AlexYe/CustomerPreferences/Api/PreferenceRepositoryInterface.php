<?php

declare(strict_types=1);

namespace AlexYe\CustomerPreferences\Api;

use AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface PreferenceRepositoryInterface
{
    /**
     * Get product list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PreferenceSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PreferenceSearchResultInterface;
}
