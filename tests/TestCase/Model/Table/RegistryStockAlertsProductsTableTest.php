<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegistryStockAlertsProductsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegistryStockAlertsProductsTable Test Case
 */
class RegistryStockAlertsProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RegistryStockAlertsProductsTable
     */
    protected $RegistryStockAlertsProducts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RegistryStockAlertsProducts',
        'app.RegistryStockAlerts',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RegistryStockAlertsProducts') ? [] : ['className' => RegistryStockAlertsProductsTable::class];
        $this->RegistryStockAlertsProducts = $this->getTableLocator()->get('RegistryStockAlertsProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RegistryStockAlertsProducts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RegistryStockAlertsProductsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RegistryStockAlertsProductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
