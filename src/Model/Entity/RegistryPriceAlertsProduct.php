<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegistryPriceAlertsProduct Entity
 *
 * @property int $id
 * @property int $registry_price_alert_id
 * @property int $product_id
 * @property string $price
 * @property string $competitor_price
 * @property string $competitor_name
 *
 * @property \App\Model\Entity\RegistryPriceAlert $registry_price_alert
 * @property \App\Model\Entity\Product $product
 */
class RegistryPriceAlertsProduct extends Entity
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
        'registry_price_alert_id' => true,
        'product_id' => true,
        'price' => true,
        'competitor_price' => true,
        'competitor_name' => true,
        'registry_price_alert' => true,
        'product' => true,
    ];
}
