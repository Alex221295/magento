<?php

declare(strict_types=1);

namespace AlexYe\CustomerPreferences\Model;

use AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterface;
use AlexYe\CustomerPreferences\Api\Data\PreferenceInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;

class PreferenceRepository implements \AlexYe\CustomerPreferences\Api\PreferenceRepositoryInterface
{
    /**
     * @var \Magento\Framework\EntityManager\EntityManager $entityManager
     */
    private $entityManager;

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
     * @param \Magento\Framework\EntityManager\EntityManager $entityManager
     * @param \AlexYe\CustomerPreferences\Model\ResourceModel\Preference\CollectionFactory $preferencesCollectionFactory
     * @param \AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterfaceFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     * @param \AlexYe\CustomerPreferences\Api\Data\PreferenceInterfaceFactory $preferenceDataFactory
     */
    public function __construct(
        \Magento\Framework\EntityManager\EntityManager $entityManager,
        \AlexYe\CustomerPreferences\Model\ResourceModel\Preference\CollectionFactory $preferencesCollectionFactory,
        \AlexYe\CustomerPreferences\Api\Data\PreferenceSearchResultInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \AlexYe\CustomerPreferences\Api\Data\PreferenceInterfaceFactory $preferenceDataFactory
    ) {
        $this->entityManager = $entityManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->preferencesCollectionFactory = $preferencesCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->preferenceDataFactory = $preferenceDataFactory;
    }

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(PreferenceInterface $preference): PreferenceInterface
    {
        try {
            $this->entityManager->save($preference);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $preference;
    }

    /**
     * @inheritdoc
     */
    public function get(int $preferenceId): PreferenceInterface
    {
        $customer = $this->preferenceDataFactory->create();

        return $this->entityManager->load($customer, $preferenceId);
    }

    /**
     * @inheritdoc
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

    /**
     * @inheritdoc
     */
    public function delete(PreferenceInterface $preference): bool
    {
        try {
            $this->entityManager->delete($preference);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $preferenceId): bool
    {
        return $this->delete($this->get($preferenceId));
    }
}
