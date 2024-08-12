<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TagsTagsFixture
 */
class TagsTagsFixture extends TestFixture
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
                'namespace' => 'Lorem ipsum dolor sit amet',
                'slug' => 'Lorem ipsum dolor sit amet',
                'label' => 'Lorem ipsum dolor sit amet',
                'counter' => 1,
                'created' => '2024-08-07 23:50:57',
                'modified' => '2024-08-07 23:50:57',
            ],
        ];
        parent::init();
    }
}
