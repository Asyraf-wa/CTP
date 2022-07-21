<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Publication Entity
 *
 * @property string $id
 * @property int $user_id
 * @property int $year
 * @property string $type
 * @property string $title
 * @property string $keywords
 * @property string $authors
 * @property string $abstract
 * @property string $diciplines
 * @property string|null $sponsor
 * @property string $pointer
 * @property string $link
 * @property string|null $note
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Publication extends Entity
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
        'year' => true,
        'journal_name' => true,
        'volume' => true,
        'issue' => true,
        'pages' => true,
        'doi' => true,
        'serial' => true,
        'paper_type' => true,
        'manuscript_title' => true,
        'keywords' => true,
        'authors' => true,
        'abstract' => true,
        'diciplines' => true,
        'sponsor' => true,
        'pointer' => true,
        'url' => true,
        'note' => true,
        'status' => true,
        'attachment' => true,
        'attachment_dir' => true,
        'created' => true,
        'modified' => true,
        'slug' => true,
        'user' => true,
        'reference' => true,
    ];
}
