<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PainsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PainsTable Test Case
 */
class PainsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PainsTable
     */
    protected $Pains;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Pains',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pains') ? [] : ['className' => PainsTable::class];
        $this->Pains = $this->getTableLocator()->get('Pains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Pains);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PainsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PainsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
