<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Xml;
use Cake\Validation\Validator;

/**
 * ProductPrices Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\ProductPrice newEmptyEntity()
 * @method \App\Model\Entity\ProductPrice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductPrice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductPrice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductPrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductPrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductPrice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductPrice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductPrice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductPrice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProductPricesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('product_prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('shop_id')
            ->notEmptyString('shop_id');

        $validator
            ->decimal('cost')
            ->requirePresence('cost', 'create')
            ->notEmptyString('cost');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('product_id', 'Products'), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn('shop_id', 'Shops'), ['errorField' => 'shop_id']);

        return $rules;
    }
    public function updatePrices()
    {
        $http = new Client(['timeout' => 600]);
        $response = $http->get(Configure::read('Atida.urls.productFeedUrl'));
        $xml = Xml::build($response->getStringBody(), ['parseHuge' => true]);
        $productPrices = array();
        $items_added = 0;
        $items_updated = 0;
        foreach ($xml->channel->item as $item) {
            $sku = (string)$item->children('g',TRUE)->id;
            $product_id = $this->Products->findBySku($sku)
                ->select('id')
                ->first();
            if($product_id != null) {
                $shop_id = $this->Shops->findByName('Atida_ES')
                    ->select('id')
                    ->first();
                $productPrice = $this->find()
                    ->where(['ProductPrices.product_id' => $product_id['id'], 'ProductPrices.shop_id' => $shop_id['id']])
                    ->first();
                if ($productPrice == null) {
                    $productPrice = $this->newEmptyEntity();
                    $productPrice->product_id = $product_id['id'];
                    $productPrice->shop_id = $shop_id['id'];
                    $productPrice->cost = (float)$item->children('g', TRUE)->cost;
                    $productPrice->price = (float)$item->children('g', TRUE)->price;
                    $productPrices [] = $productPrice;
                    $items_added++;
                } else {
                    $productPrice->cost = (float)$item->children('g', TRUE)->cost;
                    $productPrice->price = (float)$item->children('g', TRUE)->price;
                    $productPrices [] = $productPrice;
                    $items_updated++;
                }
            } else
                print_r('No existe producto con el sku seleccionado');
        }
        $this->saveMany($productPrices);
        Log::write('info', '{items_added} product price added', ['items_added' => $items_added]);
        Log::write('info', '{items_updated} product price updated', ['items_updated' =>$items_updated]);
    }
}
