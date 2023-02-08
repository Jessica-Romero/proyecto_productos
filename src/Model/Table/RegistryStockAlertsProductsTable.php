<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegistryStockAlertsProducts Model
 *
 * @property \App\Model\Table\RegistryStockAlertsTable&\Cake\ORM\Association\BelongsTo $RegistryStockAlerts
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\RegistryStockAlertsProduct newEmptyEntity()
 * @method \App\Model\Entity\RegistryStockAlertsProduct newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryStockAlertsProduct[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RegistryStockAlertsProductsTable extends Table
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

        $this->setTable('registry_stock_alerts_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RegistryStockAlerts', [
            'foreignKey' => 'registry_stock_alert_id',
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
            ->integer('registry_stock_alert_id')
            ->requirePresence('registry_stock_alert_id', 'create')
            ->notEmptyString('registry_stock_alert_id');

        $validator
            ->integer('product_id')
            ->requirePresence('product_id', 'create')
            ->notEmptyString('product_id');

        $validator
            ->integer('available_stock')
            ->requirePresence('available_stock', 'create')
            ->notEmptyString('available_stock');

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
        $rules->add($rules->existsIn('registry_stock_alert_id', 'RegistryStockAlerts'), ['errorField' => 'registry_stock_alert_id']);
        $rules->add($rules->existsIn('product_id', 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
    public function addNewRegistryProduct($registry_id,$alertProducts,$isByBrand)
    {
        $result = 0;
        $registries = array();
        if($isByBrand) {
            for ($i = 0; $i < count($alertProducts); $i++) {
                $registry = $this->newEmptyEntity();
                $registry->registry_stock_alert_id = $registry_id;
                $registry->product_id = $alertProducts[$i]['product']->id;
                $registry->available_stock = $alertProducts[$i]->stock_level ;
                $registries [] = $registry;
            }
        }else {
            for ($i = 0; $i < count($alertProducts); $i++) {
                $registry = $this->newEmptyEntity();
                $registry->registry_stock_alert_id = $registry_id;
                $registry->product_id = $alertProducts[$i]->id;
                $registry->available_stock = $alertProducts[$i]['product_stock'][0]->stock_level ;
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
