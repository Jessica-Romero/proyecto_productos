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
 * ProductStock Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\ProductStock newEmptyEntity()
 * @method \App\Model\Entity\ProductStock newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductStock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductStock get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductStock findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductStock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductStock[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductStock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductStock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductStock[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductStock[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductStock[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductStock[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductStockTable extends Table
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

        $this->setTable('product_stock');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->boolean('in_stock')
            ->requirePresence('in_stock', 'create')
            ->notEmptyString('in_stock');

        $validator
            ->integer('stock_level')
            ->notEmptyString('stock_level');

        $validator
            ->integer('sales_last_days')
            ->requirePresence('sales_last_days', 'create')
            ->notEmptyString('sales_last_days');

        $validator
            ->scalar('rating')
            ->maxLength('rating', 2)
            ->requirePresence('rating', 'create')
            ->notEmptyString('rating');

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
    public function updateFieldStock()
    {
        $http = new Client(['timeout' => 600]);
        $response = $http->get(Configure::read('Atida.urls.productFeedUrl'));
        $xml = Xml::build($response->getStringBody(), ['parseHuge' => true]);
        $productStocks = array();
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
                $productStock = $this->find()
                    ->where(['product_id' => $product_id['id'], 'shop_id' => $shop_id['id']])
                    ->first();
                if ($productStock == null) {
                    $productStock = $this->newEmptyEntity();
                    $productStock->product_id = $product_id['id'];
                    $productStock->shop_id = $shop_id['id'];
                    $productStock->in_stock = ((string)$item->children('g', TRUE)->availability == 'in stock') ? true : false;
                    $productStock->rating = (string)$item->rating;
                    $productStock->sales_last_days = (int)$item->sales_last_days;
                    $productStocks [] = $productStock;
                    $items_added++;
                } else {
                    $productStock->in_stock = ((string)$item->children('g', TRUE)->availability == 'in stock') ? true : false;
                    $productStock->rating = (string)$item->rating;
                    $productStock->sales_last_days = (int)$item->sales_last_days;
                    $productStocks [] = $productStock;
                    $items_updated++;
                }
            } else
                print_r('No existe producto con el sku seleccionado');
        }
        $this->saveMany($productStocks);
        Log::write('info', '{items_added} product field stock  added', ['items_added' => $items_added]);
        Log::write('info', '{items_updated} product field stock updated', ['items_updated' =>$items_updated]);
    }
    public function updateStockFromTryton()
    {
        $http = new Client([
            'headers' => ['Authorization' => 'Bearer ' . Configure::read('Tryton.secret')],
            'timeout' => 600
        ]);

        $response = $http->get(Configure::read('Tryton.urls.productAvailabilityUrl'));
        $stock_levels = $response->getJson();
        $productStocks= array();
        $result = true;

        if($stock_levels){
            foreach ($stock_levels['data'] as $item) {
                $product_id = $this->Products->findBySku((string)$item['sku'])
                    ->select('id')
                    ->first();
                if($product_id != null){
                    $productsStockLevel = $this->find()
                        ->where(['product_id' => $product_id['id']]);
                }
                if($productsStockLevel != null) {
                    foreach ($productsStockLevel as $productStockLevel) {
                        $productStockLevel->stock_level = (int)$item['quantity'];
                        $productStocks [] = $productStockLevel;
                    }
                }
            }
        }
        $this->saveMany($productStocks);

        Log::write('info', 'Stock Level updated!');
        return $result;
    }
}
