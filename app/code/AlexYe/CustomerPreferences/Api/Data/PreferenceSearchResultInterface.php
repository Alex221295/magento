<?php

declare(strict_types=1);

namespace AlexYe\CustomerPreferences\Api\Data;

/**
 * Must redefine the interface methods for \Magento\Framework\Reflection\DataObjectProcessor::buildOutputDataArray()
 * Must not declare return types to keep the interface consistent with the parent interface
 */
interface PreferenceSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \AlexYe\CustomerPreferences\Api\Data\PreferenceInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \AlexYe\CustomerPreferences\Api\Data\PreferenceInterface[] $items
     * @return $this
     */
    public function setItems(array $items = null);
}
