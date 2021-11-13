<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Blog Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $poster
 * @property string $poster_dir
 * @property int $hits
 * @property int $kudos
 * @property bool $published
 * @property string $meta_key
 * @property string $meta_description
 * @property \Cake\I18n\FrozenDate $publish_on
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Blog extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'poster' => true,
        'poster_dir' => true,
		'word_count' => true,
        'hits' => true,
        'kudos' => true,
        'published' => true,
        'meta_key' => true,
        'meta_description' => true,
        'publish_on' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
