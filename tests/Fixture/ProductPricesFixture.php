<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductPricesFixture
 */
class ProductPricesFixture extends TestFixture
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
                'product_id' => 1,
                'shop_id' => 1,
                'cost' => 1.5,
                'price' => 1.5,
            ],
        ];
        parent::init();
    }
}
