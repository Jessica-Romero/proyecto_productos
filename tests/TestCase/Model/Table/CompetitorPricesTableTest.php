<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompetitorPricesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompetitorPricesTable Test Case
 */
class CompetitorPricesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CompetitorPricesTable
     */
    protected $CompetitorPrices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CompetitorPrices',
        'app.Competitors',
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
        $config = $this->getTableLocator()->exists('CompetitorPrices') ? [] : ['className' => CompetitorPricesTable::class];
        $this->CompetitorPrices = $this->getTableLocator()->get('CompetitorPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CompetitorPrices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CompetitorPricesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CompetitorPricesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
