<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TagsTag Entity
 *
 * @property int $id
 * @property string|null $namespace
 * @property string $slug
 * @property string $label
 * @property int $counter
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class TagsTag extends Entity
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
        'namespace' => true,
        'slug' => true,
        'label' => true,
        'counter' => true,
        'created' => true,
        'modified' => true,
    ];
}
