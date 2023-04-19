<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegistryStockAlertsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegistryStockAlertsTable Test Case
 */
class RegistryStockAlertsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RegistryStockAlertsTable
     */
    protected $RegistryStockAlerts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RegistryStockAlerts',
        'app.Stockalerts',
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
        $config = $this->getTableLocator()->exists('RegistryStockAlerts') ? [] : ['className' => RegistryStockAlertsTable::class];
        $this->RegistryStockAlerts = $this->getTableLocator()->get('RegistryStockAlerts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RegistryStockAlerts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RegistryStockAlertsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RegistryStockAlertsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
