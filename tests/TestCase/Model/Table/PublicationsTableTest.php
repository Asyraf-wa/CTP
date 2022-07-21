<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PublicationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PublicationsTable Test Case
 */
class PublicationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PublicationsTable
     */
    protected $Publications;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Publications',
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
        $config = $this->getTableLocator()->exists('Publications') ? [] : ['className' => PublicationsTable::class];
        $this->Publications = $this->getTableLocator()->get('Publications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Publications);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PublicationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PublicationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
