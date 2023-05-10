<?php
declare(strict_types=1);

namespace AlexYe\CustomerPreferences\Setup\Patch\Schema;

class DropPreferedValuesColumn implements \Magento\Framework\Setup\Patch\SchemaPatchInterface
{
    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface $schemaSetup
     */
    private $schemaSetup;

    /**
     * RemoveOldForeignKeys constructor.
     * @param \Magento\Framework\Setup\SchemaSetupInterface $schemaSetup
     */
    public function __construct(
        \Magento\Framework\Setup\SchemaSetupInterface $schemaSetup
    ) {
        $this->schemaSetup = $schemaSetup;
    }

    /**
     * @inheritDoc
     */
    public function apply(): void
    {
        $this->schemaSetup->getConnection()
            ->dropColumn(
                $this->schemaSetup->getTable('alex_ye_customer_preferences'),
                'prefered_values'
            );
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [
            RemoveDemoColumn::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
