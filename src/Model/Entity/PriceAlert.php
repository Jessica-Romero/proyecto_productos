<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PriceAlert Entity
 *
 * @property int $id
 * @property int $brand_id
 * @property int $shop_id
 * @property string $emails
 * @property bool|null $active
 * @property int $type_alert_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\TypeAlert $type_alert
 */
class PriceAlert extends Entity
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
        'shop_id' => true,
        'emails' => true,
        'active' => true,
        'type_alert_id' => true,
        'created' => true,
        'modified' => true,
        'brand' => true,
        'shop' => true,
        'type_alert' => true,
        'products' => true,
    ];
}
