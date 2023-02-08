<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistryPriceAlertsProductsFixture
 */
class RegistryPriceAlertsProductsFixture extends TestFixture
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
                'registry_price_alert_id' => 1,
                'product_id' => 1,
                'price' => 1.5,
                'competitor_price' => 1.5,
                'competitor_name' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
