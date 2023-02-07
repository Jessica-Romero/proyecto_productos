<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductPricesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductPricesTable Test Case
 */
class ProductPricesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductPricesTable
     */
    protected $ProductPrices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProductPrices',
        'app.Products',
        'app.Shops',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductPrices') ? [] : ['className' => ProductPricesTable::class];
        $this->ProductPrices = $this->getTableLocator()->get('ProductPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductPrices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductPricesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProductPricesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
