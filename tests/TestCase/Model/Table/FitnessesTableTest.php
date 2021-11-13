<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FitnessesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FitnessesTable Test Case
 */
class FitnessesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FitnessesTable
     */
    protected $Fitnesses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Fitnesses',
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
        $config = $this->getTableLocator()->exists('Fitnesses') ? [] : ['className' => FitnessesTable::class];
        $this->Fitnesses = $this->getTableLocator()->get('Fitnesses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Fitnesses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FitnessesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FitnessesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
