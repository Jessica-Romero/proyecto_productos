<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\RegistryStockAlertsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\RegistryStockAlertsController Test Case
 *
 * @uses \App\Controller\RegistryStockAlertsController
 */
class RegistryStockAlertsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RegistryStockAlerts',
        'app.Stockalerts',
        'app.Products',
        'app.RegistryStockAlertsProducts',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\RegistryStockAlertsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\RegistryStockAlertsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\RegistryStockAlertsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\RegistryStockAlertsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\RegistryStockAlertsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
