<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Core\Configure;
use Cake\ORM\Table;
use Cake\Utility\Xml;
use Cake\Validation\Validator;
use Cake\Http\Client;
use Cake\Log\Log;

/**
 * Products Model
 *
 * @property \App\Model\Table\BrandsTable&\Cake\ORM\Association\BelongsTo $Brands
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id',
        ]);
        $this->belongsToMany('StockAlerts', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'stockalerts_id',
            'joinTable' => 'stockalerts_products',
        ]);
        $this->belongsToMany('Shops', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'shop_id',
            'joinTable' => 'products_shops',
        ]);
        $this->hasMany('CompetitorPrices',[
            'sort' => ['price' => 'ASC'],
        ]);
        $this->hasMany('ProductPrices');
        $this->hasMany('ProductStock');

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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 12)
            ->requirePresence('sku', 'create')
            ->notEmptyString('sku')
            ->add('sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('brand_id')
            ->allowEmptyString('brand_id');

        $validator
            ->boolean('in_stock')
            ->requirePresence('in_stock', 'create')
            ->notEmptyString('in_stock');

        $validator
            ->decimal('cost')
            ->requirePresence('cost', 'create')
            ->notEmptyString('cost');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->integer('sales_last_days')
            ->requirePresence('sales_last_days', 'create')
            ->notEmptyString('sales_last_days');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->requirePresence('image', 'create')
            ->notEmptyFile('image');

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
        $rules->add($rules->isUnique(['sku']), ['errorField' => 'sku']);
        $rules->add($rules->existsIn('brand_id', 'Brands'), ['errorField' => 'brand_id']);

        return $rules;
    }

    public function updateProductsFromFeed()
    {
        $http = new Client(['timeout' => 600]);
        $response = $http->get(Configure::read('Atida.urls.productFeedUrl'));
        $xml = Xml::build($response->getStringBody(), ['parseHuge' => true]);
        $items_added = 0;
        $items_updated = 0;
        $result = true;
        $products = array();
        foreach ($xml->channel->item as $item) {
            $sku = (string)$item->children('g',TRUE)->id;
            $product = $this->findBySku($sku)->first();
            $brands = $this->Brands->find('list')->toArray();

            //If product doesn't exist
            if(!$product){
                $product = $this->newEmptyEntity();
                $product->name = $item->title;
                $product->sku = $sku;
                $product->image = (string)$item->children('g',TRUE)->image_link;
                $product->brand_id = array_search((string)$item->children('g',TRUE)->brand,$brands)?array_search((string)$item->children('g',TRUE)->brand,$brands):$this->Brands->addNewBrand((string)$item->children('g',TRUE)->brand);
                $items_added++;
                $products [] = $product;
                //If product exists
            }else{
                $product->name = $item->title;
                $product->image = (string)$item->children('g',TRUE)->image_link;
                $product->brand_id = array_search((string)$item->children('g',TRUE)->brand,$brands)?array_search((string)$item->children('g',TRUE)->brand,$brands):$this->Brands->addNewBrand((string)$item->children('g',TRUE)->brand);
                $products[] = $product;
                $items_updated++;
            }
        }
        $this->saveMany($products);
        Log::write('info', '{items_added} products added', ['items_added' => $items_added]);
        Log::write('info', '{items_updated} products updated', ['items_updated' =>$items_updated]);

    }

}
