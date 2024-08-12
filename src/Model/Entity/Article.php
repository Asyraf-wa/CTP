<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string|null $icon
 * @property string $poster
 * @property string $poster_dir
 * @property bool|null $featured
 * @property int $hits
 * @property int $kudos
 * @property int $status
 * @property string $meta_key
 * @property string $meta_description
 * @property \Cake\I18n\Date $publish_on
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Article extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'category_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'icon' => true,
        'poster' => true,
        'poster_dir' => true,
        'featured' => true,
        'hits' => true,
        'kudos' => true,
        'status' => true,
        'meta_key' => true,
        'meta_description' => true,
        'publish_on' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
