<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
{
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
                'name' => 'Lorem ipsum dolor sit amet',
                'sku' => 'Lorem ipsu',
                'brand_id' => 1,
                'in_stock' => 1,
                'cost' => 1.5,
                'price' => 1.5,
                'sales_last_days' => 1,
                'image' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-10-24 12:21:26',
                'modified' => '2022-10-24 12:21:26',
            ],
        ];
        parent::init();
    }
}
