<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistryPriceAlertsFixture
 */
class RegistryPriceAlertsFixture extends TestFixture
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
                'pricealert_id' => 1,
                'created' => '2023-02-08 17:46:20',
                'modified' => '2023-02-08 17:46:20',
            ],
        ];
        parent::init();
    }
}
