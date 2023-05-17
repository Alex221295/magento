<?php

declare(strict_types=1);

namespace AlexYe\CustomerPreferences\Model;

use AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class PreferenceRepository implements \AlexYe\CustomerPreferences\Api\PreferenceRepositoryInterface
{
    /**
     * @var \AlexYe\CustomerPreferences\Model\ResourceModel\Preference\CollectionFactory $preferencesCollectionFactory
     */
    private $preferencesCollectionFactory;

    /**
     * @var \AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterfaceFactory $searchResultsFactory
     */
    private $searchResultsFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     **/
    private $collectionProcessor;

    /**
     * @var \AlexYe\CustomerPreferences\Api\Data\PreferenceInterfaceFactory $preferenceDataFactory
     */
    private $preferenceDataFactory;

    /**
     * PreferenceRepository constructor.
     * @param \AlexYe\CustomerPreferences\Model\ResourceModel\Preference\CollectionFactory $preferencesCollectionFactory
     * @param \AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterfaceFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     * @param \AlexYe\CustomerPreferences\Api\Data\PreferenceInterfaceFactory $preferenceDataFactory
     */
    public function __construct(
        \AlexYe\CustomerPreferences\Model\ResourceModel\Preference\CollectionFactory $preferencesCollectionFactory,
        \AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \AlexYe\CustomerPreferences\Api\Data\PreferenceInterfaceFactory $preferenceDataFactory
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->preferencesCollectionFactory = $preferencesCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->preferenceDataFactory = $preferenceDataFactory;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PreferenceSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PreferenceSearchResultInterface
    {
        $preferencesCollection = $this->preferencesCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $preferencesCollection);
        $preferences = [];

        /** @var Preference $preference */
        foreach ($preferencesCollection as $preference) {
            $data = $preference->getData();
            $data['id'] = $preference->getId();
            $data['attribute_code'] = $preference->getAttributeCode();
            $preferences[] = $this->preferenceDataFactory->create(['data' => $data]);
        }

        /** @var PreferenceSearchResultInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setTotalCount($preferencesCollection->getSize());
        $searchResults->setItems($preferences);

        return $searchResults;
    }
}
