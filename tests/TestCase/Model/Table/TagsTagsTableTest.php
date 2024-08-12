<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TagsTagsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TagsTagsTable Test Case
 */
class TagsTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TagsTagsTable
     */
    protected $TagsTags;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TagsTags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TagsTags') ? [] : ['className' => TagsTagsTable::class];
        $this->TagsTags = $this->getTableLocator()->get('TagsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TagsTags);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TagsTagsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
