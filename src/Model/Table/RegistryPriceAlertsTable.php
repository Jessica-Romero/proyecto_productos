<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegistryPriceAlerts Model
 *
 * @property \App\Model\Table\PriceAlertsTable&\Cake\ORM\Association\BelongsTo $Pricealerts
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsToMany $Products
 *
 * @method \App\Model\Entity\RegistryPriceAlert newEmptyEntity()
 * @method \App\Model\Entity\RegistryPriceAlert newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RegistryPriceAlert[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegistryPriceAlertsTable extends Table
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

        $this->setTable('registry_price_alerts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PriceAlerts', [
            'foreignKey' => 'pricealert_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('AlertProducts', [
            'className' => 'RegistryPriceAlertsProducts',
            'foreignKey' => 'registry_price_alert_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'registry_price_alerts_products',
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
            ->integer('pricealert_id')
            ->requirePresence('pricealert_id', 'create')
            ->notEmptyString('pricealert_id');

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
        $rules->add($rules->existsIn('pricealert_id', 'PriceAlerts'), ['errorField' => 'pricealert_id']);

        return $rules;
    }
    public function addNewRegistry($alert_id,$alertProducts,$competitors,$isByBrand)
    {
        $result = 0;
        $registry = $this->newEmptyEntity();
        $registry->pricealert_id = $alert_id;
        if ($this->save($registry)) {
            $result = $registry->id;
            $this->AlertProducts->addNewRegistryProduct($registry->id,$alertProducts,$competitors,$isByBrand);
            Log::write('info', 'The registry price alert added', ['registry' => $registry->id]);
            $result= $registry->id;
            return $result;
        }else{
            Log::write('error', 'An error ocurred adding {registry price alert}', ['registry' => $alert_id]);
            $result = false;
            return $result;
        }


    }
}
