<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\QuotesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\QuotesController Test Case
 *
 * @uses \App\Controller\QuotesController
 */
class QuotesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Quotes',
    ];

    /**
     * Test beforeFilter method
     *
     * @return void
     * @uses \App\Controller\QuotesController::beforeFilter()
     */
    public function testBeforeFilter(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test json method
     *
     * @return void
     * @uses \App\Controller\QuotesController::json()
     */
    public function testJson(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test csv method
     *
     * @return void
     * @uses \App\Controller\QuotesController::csv()
     */
    public function testCsv(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test pdfList method
     *
     * @return void
     * @uses \App\Controller\QuotesController::pdfList()
     */
    public function testPdfList(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\QuotesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\QuotesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\QuotesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\QuotesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\QuotesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test archived method
     *
     * @return void
     * @uses \App\Controller\QuotesController::archived()
     */
    public function testArchived(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
