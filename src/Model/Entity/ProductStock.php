<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductStock Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $shop_id
 * @property bool $in_stock
 * @property int $stock_level
 * @property int $sales_last_days
 * @property string $rating
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Shop $shop
 */
class ProductStock extends Entity
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
        'product_id' => true,
        'shop_id' => true,
        'in_stock' => true,
        'stock_level' => true,
        'sales_last_days' => true,
        'rating' => true,
        'created' => true,
        'modified' => true,
        'product' => true,
        'shop' => true,
    ];
}
