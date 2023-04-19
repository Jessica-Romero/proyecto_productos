<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockAlertsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockAlertsTable Test Case
 */
class StockAlertsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StockAlertsTable
     */
    protected $StockAlerts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.StockAlerts',
        'app.Brands',
        'app.TypeAlerts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('StockAlerts') ? [] : ['className' => StockAlertsTable::class];
        $this->StockAlerts = $this->getTableLocator()->get('StockAlerts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->StockAlerts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\StockAlertsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\StockAlertsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
