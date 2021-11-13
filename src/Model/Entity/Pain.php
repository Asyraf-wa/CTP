<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pain Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property int $feel
 * @property string $medication
 * @property \Cake\I18n\FrozenDate $date
 * @property string $pain_point
 * @property string $cause
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Pain extends Entity
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
        'feel' => true,
        'medication' => true,
        'date' => true,
        'pain_point' => true,
        'cause' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
