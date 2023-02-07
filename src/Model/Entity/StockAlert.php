<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockAlert Entity
 *
 * @property int $id
 * @property int $brand_id
 * @property string $emails
 * @property int $value
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $type_alert_id
 *
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\TypeAlert $type_alert
 */
class StockAlert extends Entity
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
    protected $_accessible = [
        'brand_id' => true,
        'emails' => true,
        'value' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'type_alert_id' => true,
        'brand' => true,
        'type_alert' => true,
    ];
}
