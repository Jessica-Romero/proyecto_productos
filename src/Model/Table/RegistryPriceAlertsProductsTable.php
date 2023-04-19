<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegistryPriceAlertsProducts Model
 *
 * @property \App\Model\Table\RegistryPriceAlertsTable&\Cake\ORM\Association\BelongsTo $RegistryPriceAlerts
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\RegistryPriceAlertsProduct newEmptyEntity()
 * @method \App\Model\Entity\RegistryPriceAlertsProduct newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlertsProduct[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RegistryPriceAlertsProductsTable extends Table
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

        $this->setTable('registry_price_alerts_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RegistryPriceAlerts', [
            'foreignKey' => 'registry_price_alert_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
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
            ->integer('registry_price_alert_id')
            ->requirePresence('registry_price_alert_id', 'create')
            ->notEmptyString('registry_price_alert_id');

        $validator
            ->integer('product_id')
            ->requirePresence('product_id', 'create')
            ->notEmptyString('product_id');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->decimal('competitor_price')
            ->requirePresence('competitor_price', 'create')
            ->notEmptyString('competitor_price');

        $validator
            ->scalar('competitor_name')
            ->maxLength('competitor_name', 255)
            ->requirePresence('competitor_name', 'create')
            ->notEmptyString('competitor_name');

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
        $rules->add($rules->existsIn('registry_price_alert_id', 'RegistryPriceAlerts'), ['errorField' => 'registry_price_alert_id']);
        $rules->add($rules->existsIn('product_id', 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
    public function addNewRegistryProduct($registry_id,$alertProducts,$competitors,$isByBrand)
    {
        $result = 0;
        $registries = array();
        if($isByBrand) {
            for ($i = 0; $i < count($alertProducts); $i++) {
                $registry = $this->newEmptyEntity();
                $registry->registry_price_alert_id = $registry_id;
                $registry->product_id = $alertProducts[$i]['product']->id;
                $registry->price = $alertProducts[$i]->price;
                $registry->competitor_price = $competitors[$i]->price;
                $registry->competitor_name = $competitors[$i]['competitor']->name;
                $registries [] = $registry;
            }
        }else {
            for ($i = 0; $i < count($alertProducts); $i++) {
                $registry = $this->newEmptyEntity();
                $registry->registry_price_alert_id = $registry_id;
                $registry->product_id = $alertProducts[$i][0]['product']->id;
                $registry->price = $alertProducts[$i][0]->price;
                $registry->competitor_price = $competitors[$i]->price;
                $registry->competitor_name = $competitors[$i]['competitor']->name;
                $registries [] = $registry;
            }
        }
        if ($this->saveMany($registries)) {
            Log::write('info', 'The registry price alert product added');
        }else{
            Log::write('error', 'An error ocurred adding {registry price alert}', ['registry' => $alert_id]);
            $result = false;
        }
        return $result;
    }
}
