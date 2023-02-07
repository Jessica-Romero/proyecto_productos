<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompetitorPricesFixture
 */
class CompetitorPricesFixture extends TestFixture
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
                'competitor_id' => 1,
                'product_id' => 1,
                'price' => 1.5,
                'created' => '2023-02-06 17:24:46',
                'modified' => '2023-02-06 17:24:46',
            ],
        ];
        parent::init();
    }
}
