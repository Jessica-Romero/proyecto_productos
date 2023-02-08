<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegistryPriceAlertsProductsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegistryPriceAlertsProductsTable Test Case
 */
class RegistryPriceAlertsProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RegistryPriceAlertsProductsTable
     */
    protected $RegistryPriceAlertsProducts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RegistryPriceAlertsProducts',
        'app.RegistryPriceAlerts',
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
        $config = $this->getTableLocator()->exists('RegistryPriceAlertsProducts') ? [] : ['className' => RegistryPriceAlertsProductsTable::class];
        $this->RegistryPriceAlertsProducts = $this->getTableLocator()->get('RegistryPriceAlertsProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RegistryPriceAlertsProducts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RegistryPriceAlertsProductsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RegistryPriceAlertsProductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
