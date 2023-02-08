<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegistryStockAlerts Model
 *
 * @property \App\Model\Table\StockAlertsTable&\Cake\ORM\Association\BelongsTo $Stockalerts
 *
 * @method \App\Model\Entity\RegistryStockAlert newEmptyEntity()
 * @method \App\Model\Entity\RegistryStockAlert newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlert get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegistryStockAlert findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RegistryStockAlert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlert[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryStockAlert|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryStockAlert saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryStockAlert[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryStockAlert[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryStockAlert[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryStockAlert[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegistryStockAlertsTable extends Table
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

        $this->setTable('registry_stock_alerts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('StockAlerts', [
            'foreignKey' => 'stockalert_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('AlertProductsStock', [
            'className' => 'RegistryStockAlertsProducts',
            'foreignKey' => 'registry_stock_alert_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'registry_stock_alerts_products',
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
            ->integer('stockalert_id')
            ->requirePresence('stockalert_id', 'create')
            ->notEmptyString('stockalert_id');

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
        $rules->add($rules->existsIn('stockalert_id', 'StockAlerts'), ['errorField' => 'stockalert_id']);

        return $rules;
    }
    public function addNewRegistry($alert_id,$alertProducts,$isByBrand)
    {
        $result = 0;
        $registry = $this->newEmptyEntity();
        $registry->stockalert_id = $alert_id;
        if ($this->save($registry)) {
            $result = $registry->id;
            $this->AlertProductsStock->addNewRegistryProduct($registry->id,$alertProducts,$isByBrand);
            Log::write('info', 'The registry stock alert added', ['registry' => $registry->id]);
            $result= $registry->id;
            return $result;
        }else{
            Log::write('error', 'An error ocurred adding {registry stock alert}', ['registry' => $alert_id]);
            $result = false;
            return $result;
        }

    }
}
