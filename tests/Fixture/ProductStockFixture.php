<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductStockFixture
 */
class ProductStockFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'product_stock';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'product_id' => 1,
                'shop_id' => 1,
                'in_stock' => 1,
                'stock_level' => 1,
                'sales_last_days' => 1,
                'rating' => 'Lo',
                'created' => '2023-01-19 17:08:01',
                'modified' => '2023-01-19 17:08:01',
            ],
        ];
        parent::init();
    }
}
