<?php

namespace AlexYe\CustomerPreferences\Model\ResourceModel\Preference;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        parent::_construct();
        $this->_init(
            \AlexYe\CustomerPreferences\Model\Preference::class,
            \AlexYe\CustomerPreferences\Model\ResourceModel\Preference::class
        );
    }

    /**
     * @param int $websiteId
     * @return Collection
     */
    public function addWebsiteFilter(int $websiteId): self
    {
        return $this->addFieldToFilter('website_id', $websiteId);
    }

    /**
     * @param int $customerId
     * @return Collection
     */
    public function addCustomerFilter(int $customerId): self
    {
        return $this->addFieldToFilter('customer_id', $customerId);
    }
}