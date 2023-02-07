<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompetitorPrice Entity
 *
 * @property int $id
 * @property int $competitor_id
 * @property int $product_id
 * @property string $price
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Competitor $competitor
 * @property \App\Model\Entity\Product $product
 */
class CompetitorPrice extends Entity
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
        'competitor_id' => true,
        'product_id' => true,
        'price' => true,
        'created' => true,
        'modified' => true,
        'competitor' => true,
        'product' => true,
    ];
}
