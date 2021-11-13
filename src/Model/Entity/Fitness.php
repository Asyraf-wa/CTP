<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fitness Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property int $counter
 * @property string $latitude
 * @property string $longitude
 * @property int $status
 * @property \Cake\I18n\FrozenTime $registered_on
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Fitness extends Entity
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
        'type' => true,
        'counter' => true,
        'latitude' => true,
        'longitude' => true,
        'status' => true,
        'registered_on' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
