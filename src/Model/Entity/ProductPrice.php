<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductPrice Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $shop_id
 * @property string $cost
 * @property string $price
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Shop $shop
 */
class ProductPrice extends Entity
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
        'cost' => true,
        'price' => true,
        'product' => true,
        'shop' => true,
    ];
}
