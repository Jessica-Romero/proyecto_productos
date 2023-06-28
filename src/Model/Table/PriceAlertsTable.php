<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PriceAlerts Model
 *
 * @property \App\Model\Table\BrandsTable&\Cake\ORM\Association\BelongsTo $Brands
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\PriceAlert newEmptyEntity()
 * @method \App\Model\Entity\PriceAlert newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PriceAlert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PriceAlert get($primaryKey, $options = [])
 * @method \App\Model\Entity\PriceAlert findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PriceAlert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PriceAlert[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PriceAlert|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PriceAlert saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PriceAlert[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PriceAlert[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PriceAlert[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PriceAlert[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PriceAlertsTable extends Table
{
    use MailerAwareTrait;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('price_alerts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsToMany('Products', [
            'foreignKey' => 'pricealert_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'pricealerts_products',
        ]);
        $this->belongsTo('TypeAlerts', [
            'foreignKey' => 'type_alert_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('RegistryPriceAlerts');

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
            ->integer('brand_id')
            ->requirePresence('brand_id', 'create')
            ->notEmptyString('brand_id');

        $validator
            ->integer('shop_id')
            ->requirePresence('shop_id', 'create')
            ->notEmptyString('shop_id');

        $validator
            ->scalar('emails')
            ->requirePresence('emails', 'create')
            ->notEmptyString('emails');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

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
        $rules->add($rules->existsIn('brand_id', 'Brands'), ['errorField' => 'brand_id']);
        $rules->add($rules->existsIn('shop_id', 'Shops'), ['errorField' => 'shop_id']);

        return $rules;
    }
    public function runPriceAlerts()
    {
        $pricealerts_products = $this->find('all')->contain(['Products' => ['ProductPrices']])
            ->where(['PriceAlerts.active' => true])
            ->all()
            ->toArray();
        $result = true;
        $alertProducts=array();
        $competitors= array();

        if(count($pricealerts_products)>0)
        {
            foreach($pricealerts_products as $alert){

                if(!($alert->products)){
                    $brand= $alert->brand_id;

                    $products = $this->Brands->Products->ProductPrices->find('all')
                        ->contain ('Products',function(Query $q) use ($brand) {
                            return $q->where(['Products.brand_id' => $brand]);
                        })
                        ->where(['ProductPrices.shop_id' => $alert->shop_id])
                        ->toArray();

                    foreach ($products as $product)
                    {
                        $minPrice = $this->Products->CompetitorPrices->minPrice($product->product_id);
                        if($minPrice != '0') {
                            if (($product->price) > ($minPrice['price'])) {
                                array_push($alertProducts,$product);
                                array_push($competitors,$minPrice);
                            }
                        }
                    }
                    echo"Price alert with index $alert->id \n";
                    if(count($alertProducts)>0){
                        $emails = explode(',',$alert->emails);
                        $brandName= $this->Brands->findById($alert->brand_id)->toArray();
                        $this->getMailer('PriceAlert')->send('priceAlertBrands', [$emails, $alertProducts,$competitors,$brandName]);
                        $isByBrand= true;
                        $registryId= $this->RegistryPriceAlerts->addNewRegistry($alert->id,$alertProducts,$competitors,$isByBrand);
                        $this->TypeAlerts->Alerts->addNewAlert($alert,$registryId,$brandName[0]->name);
                    }
                    $alertProducts=array();
                    $competitors= array();

                } else{
                    foreach ($alert->products as $product){
                        $product_id= $product->id;
                        $product = $this->Brands->Products->ProductPrices->find('all')
                            ->contain ('Products',function(Query $q) use ($product_id) {
                                return $q->where(['Products.id' => $product_id]);
                            })
                            ->where(['ProductPrices.shop_id' => $alert->shop_id])
                            ->toArray();
                        $minPrice = $this->Products->CompetitorPrices->minPrice($product[0]->product_id);
                        if($minPrice != '0') {
                            if (($product[0]->price) > ($minPrice['price'])) {
                                array_push($alertProducts,$product);
                                array_push($competitors,$minPrice);
                            }
                        }
                    }
                    echo"Price alert with index $alert->id \n";
                    if(count($alertProducts)>0) {
                        $emails = explode(',', $alert->emails);
                        $brandName = $this->Brands->findById($alert->brand_id)->toArray();
                        $this->getMailer('PriceAlert')->send('priceAlert', [$emails, $alertProducts, $competitors,$brandName]);
                        $isByBrand = false;
                        $registryId = $this->RegistryPriceAlerts->addNewRegistry($alert->id, $alertProducts, $competitors, $isByBrand);
                        $this->TypeAlerts->Alerts->addNewAlert($alert, $registryId, $brandName[0]->name);
                    }
                    $alertProducts=array();
                    $competitors= array();
                }
            }
        }

        return $result;
    }

}
