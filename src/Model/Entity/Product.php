<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property int|null $brand_id
 * @property bool $in_stock
 * @property string $cost
 * @property string $price
 * @property int $sales_last_days
 * @property string $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Brand $brand
 */
class Product extends Entity
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
        'name' => true,
        'sku' => true,
        'brand_id' => true,
        'in_stock' => true,
        'cost' => true,
        'price' => true,
        'sales_last_days' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'brand' => true,
        'stock_level' => true,
    ];
}
