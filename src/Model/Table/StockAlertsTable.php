<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Mailer\Mailer;
use Cake\Mailer\MailerAwareTrait;
use function PHPUnit\Framework\isEmpty;

/**
 * StockAlerts Model
 *
 * @property \App\Model\Table\BrandsTable&\Cake\ORM\Association\BelongsTo $Brands
 *
 * @method \App\Model\Entity\StockAlert newEmptyEntity()
 * @method \App\Model\Entity\StockAlert newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StockAlert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockAlert get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockAlert findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StockAlert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockAlert[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockAlert|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockAlert saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockAlert[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockAlert[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockAlert[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockAlert[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockAlertsTable extends Table
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

        $this->setTable('stock_alerts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Products', [
            'foreignKey' => 'stockalert_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'stockalerts_products',
        ]);
        $this->belongsTo('TypeAlerts', [
            'foreignKey' => 'type_alert_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RegistryStockAlerts');
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
            ->scalar('emails')
            ->requirePresence('emails', 'create')
            ->notEmptyString('emails');

        $validator
            ->integer('value')
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active');

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

        return $rules;
    }

    public function runStockAlerts()
    {
        $stockalerts_products = $this->find('all')->contain(['Products' => ['ProductStock']])
            ->where(['StockAlerts.active' => true])
            ->all()
            ->toArray();
        $result = true;

        if (count($stockalerts_products) > 0) {
            foreach ($stockalerts_products as $alert) {

                if (!($alert->products)) {
                    $brand = $alert->brand_id;
                    $products = $this->Brands->Products->ProductStock->find('all')
                        ->contain('Products', function (Query $q) use ($brand) {
                            return $q->where(['Products.brand_id' => $brand]);
                        })
                        ->where(['ProductStock.stock_level <=' => $alert->value])
                        ->toArray();

                    if($products == null) {
                        print_r(' Hay stock para esta alerta');
                    }
                    else {
                        $emails = explode(',', $alert->emails);
                        $brandName= $this->Brands->findById($alert->brand_id)->toArray();
                        $this->getMailer('StockAlert')->send('stockAlertBrands', [$emails, $products, $alert,$brandName]);
                        $isByBrand= true;
                        $registryId= $this->RegistryStockAlerts->addNewRegistry($alert->id,$products,$isByBrand);
                        $this->TypeAlerts->Alerts->addNewAlert($alert,$registryId,$brandName[0]->name);
                    }
                } else {
                    $alertProducts = array();
                    foreach ($alert->products as $product) {
                        if (($product['product_stock'][0]->stock_level) <= ($alert->value)) {
                            array_push($alertProducts, $product);
                        }
                    }
                    if($alertProducts == null)
                        print_r('Existe la cantidad mínima para este producto 2');
                    else {
                        $emails = explode(',', $alert->emails);
                        $brandName= $this->Brands->findById($alert->brand_id)->toArray();
                        $this->getMailer('StockAlert')->send('stockAlert', [$emails, $alertProducts,$alert,$brandName]);
                        $isByBrand=false;
                        $registryId= $this->RegistryStockAlerts->addNewRegistry($alert->id,$alertProducts,$isByBrand);
                        $this->TypeAlerts->Alerts->addNewAlert($alert,$registryId,$brandName[0]->name);
                    }
                }
            }

            return $result;
        }
    }
}
