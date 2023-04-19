<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PriceAlertsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PriceAlertsTable Test Case
 */
class PriceAlertsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PriceAlertsTable
     */
    protected $PriceAlerts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PriceAlerts',
        'app.Brands',
        'app.Shops',
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
        $config = $this->getTableLocator()->exists('PriceAlerts') ? [] : ['className' => PriceAlertsTable::class];
        $this->PriceAlerts = $this->getTableLocator()->get('PriceAlerts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PriceAlerts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PriceAlertsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PriceAlertsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
