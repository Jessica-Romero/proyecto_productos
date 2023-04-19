<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductStockTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductStockTable Test Case
 */
class ProductStockTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductStockTable
     */
    protected $ProductStock;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProductStock',
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
        $config = $this->getTableLocator()->exists('ProductStock') ? [] : ['className' => ProductStockTable::class];
        $this->ProductStock = $this->getTableLocator()->get('ProductStock', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductStock);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductStockTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProductStockTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
