<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $category
 * @property string $title
 * @property int $year
 * @property string $slug
 * @property string $body
 * @property string $poster
 * @property string $poster_dir
 * @property int $hits
 * @property bool $published
 * @property string $progress
 * @property string $meta_key
 * @property string $meta_description
 * @property \Cake\I18n\Date $publish_on
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Project extends Entity
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
        'category' => true,
        'title' => true,
        'repo' => true,
        'year' => true,
        'slug' => true,
        'body' => true,
        'poster' => true,
        'poster_dir' => true,
        'height' => true,
        'hits' => true,
        'published' => true,
        'progress' => true,
        'meta_key' => true,
        'meta_description' => true,
        'publish_on' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
