<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Core\Configure;
use Cake\ORM\Table;
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
        $response = $http->get('https://minderest-transfer.atida.com/minderest.xml');
        $xml = $response->getXml();
        $brands = $this->Brands->find('list')->toArray();
        $items_added = 0;
        $items_updated = 0;
        $result = true;
        foreach ($xml->channel->item as $item) {
            $sku = (string)$item->children('g',TRUE)->id;
            $query = $this->findBySku($sku);

            //If product doesn't exist
            if(!$query->count()){
                $product = $this->newEmptyEntity();
                $product->id = null;
                $product->name = $item->title;
                $product->sku = $sku;
                $product->in_stock = ((string)$item->children('g',TRUE)->availability=='in stock')?true:false;
                $product->cost = (float)$item->children('g',TRUE)->cost;
                $product->price = (float)$item->children('g',TRUE)->price;
                $product->rating = (string)$item->rating;
                $product->sales_last_days = (int)$item->sales_last_days;
                $product->image = (string)$item->children('g',TRUE)->image_link;
                $product->brand_id = array_search((string)$item->children('g',TRUE)->brand,$brands)?array_search((string)$item->children('g',TRUE)->brand,$brands):$this->Brands->addNewBrand((string)$item->children('g',TRUE)->brand);

                if ($this->save($product)) {
                    $items_added++;
                    $result= true;
                }else{
                    Log::write('error', 'An error ocurred adding {sku}', ['sku' => $sku]);
                    $result = false;
                }
            //If product exists
            }else{
                $this->query()
                    ->update()
                    ->set([
                        'name' => $item->title,
                        'in_stock' => ((string)$item->children('g',TRUE)->availability=='in stock')?true:false,
                        'cost' => (float)$item->children('g',TRUE)->cost,
                        'price' => (float)$item->children('g',TRUE)->price,
                        'rating' => (string)$item->rating,
                        'sales_last_days' => (int)$item->sales_last_days,
                        'image' => (string)$item->children('g',TRUE)->image_link,
                        'brand_id' => array_search((string)$item->children('g',TRUE)->brand,$brands)?array_search((string)$item->children('g',TRUE)->brand,$brands):$this->Brands->addNewBrand((string)$item->children('g',TRUE)->brand),
                    ])
                    ->where(['sku' => (string)$item->children('g',TRUE)->id])
                    ->execute();
                $items_updated++;
            }
        }
        Log::write('info', '{items_added} products added', ['items_added' => $items_added]);
        Log::write('info', '{items_updated} products updated', ['items_updated' =>$items_updated]);

    }

    public function updateStockFromTryton()
    {
        $http = new Client([
            'headers' => ['Authorization' => 'Bearer ' . Configure::read('App.trytonSecret')]
        ]);
        $response = $http->get('https://testintegraciones.mifarma.es/mifarmadev3/productAvailability?products=[]');
        $stock_levels = $response->getJson();
        $result = true;

        if($stock_levels){
            foreach ($stock_levels['data'] as $item) {
                $this->query()
                    ->update()
                    ->set([
                        'stock_level' => (int)$item['quantity'],
                    ])
                    ->where(['sku' => (string)$item['sku']])
                    ->execute();
            }
        }

        Log::write('info', 'Stock updated!');
        dd($response);
        return $result;
    }

}
