<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeAlertsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeAlertsTable Test Case
 */
class TypeAlertsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeAlertsTable
     */
    protected $TypeAlerts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TypeAlerts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TypeAlerts') ? [] : ['className' => TypeAlertsTable::class];
        $this->TypeAlerts = $this->getTableLocator()->get('TypeAlerts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TypeAlerts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypeAlertsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
