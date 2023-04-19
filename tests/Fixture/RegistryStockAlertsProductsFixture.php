<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistryStockAlertsProductsFixture
 */
class RegistryStockAlertsProductsFixture extends TestFixture
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
                'registry_stock_alert_id' => 1,
                'product_id' => 1,
                'available_stock' => 1,
            ],
        ];
        parent::init();
    }
}
