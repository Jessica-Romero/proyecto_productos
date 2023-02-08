<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegistryStockAlertsProduct Entity
 *
 * @property int $id
 * @property int $registry_stock_alert_id
 * @property int $product_id
 * @property int $available_stock
 *
 * @property \App\Model\Entity\RegistryStockAlert $registry_stock_alert
 * @property \App\Model\Entity\Product $product
 */
class RegistryStockAlertsProduct extends Entity
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
        'registry_stock_alert_id' => true,
        'product_id' => true,
        'available_stock' => true,
        'registry_stock_alert' => true,
        'product' => true,
    ];
}
