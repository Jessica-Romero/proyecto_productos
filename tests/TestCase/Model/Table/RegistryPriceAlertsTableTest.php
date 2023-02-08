<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegistryPriceAlertsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegistryPriceAlertsTable Test Case
 */
class RegistryPriceAlertsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RegistryPriceAlertsTable
     */
    protected $RegistryPriceAlerts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RegistryPriceAlerts',
        'app.Pricealerts',
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
        $config = $this->getTableLocator()->exists('RegistryPriceAlerts') ? [] : ['className' => RegistryPriceAlertsTable::class];
        $this->RegistryPriceAlerts = $this->getTableLocator()->get('RegistryPriceAlerts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RegistryPriceAlerts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RegistryPriceAlertsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RegistryPriceAlertsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
