<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistryStockAlertsFixture
 */
class RegistryStockAlertsFixture extends TestFixture
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
                'stockalert_id' => 1,
                'created' => '2023-02-08 16:42:42',
                'modified' => '2023-02-08 16:42:42',
            ],
        ];
        parent::init();
    }
}
