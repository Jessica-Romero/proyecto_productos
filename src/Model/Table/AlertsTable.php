<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Alerts Model
 *
 * @property \App\Model\Table\TypeAlertsTable&\Cake\ORM\Association\BelongsTo $TypeAlerts
 *
 * @method \App\Model\Entity\Alert newEmptyEntity()
 * @method \App\Model\Entity\Alert newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Alert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Alert get($primaryKey, $options = [])
 * @method \App\Model\Entity\Alert findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Alert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Alert[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Alert|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Alert saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Alert[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Alert[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Alert[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Alert[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AlertsTable extends Table
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

        $this->setTable('alerts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TypeAlerts', [
            'foreignKey' => 'type_alert_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('type_alert_id')
            ->requirePresence('type_alert_id', 'create')
            ->notEmptyString('type_alert_id');

        $validator
            ->scalar('params')
            ->maxLength('params', 255)
            ->requirePresence('params', 'create')
            ->notEmptyString('params');

        $validator
            ->scalar('information')
            ->allowEmptyString('information');

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
        $rules->add($rules->existsIn('type_alert_id', 'TypeAlerts'), ['errorField' => 'type_alert_id']);

        return $rules;
    }

    public function addNewAlert ($alert,$registryId,$brandName)
    {
        $result = 0;
        $newAlert = $this->newEmptyEntity();
        $newAlert->name = 'Alert has occurred with this brand '.$brandName;
        $newAlert->type_alert_id = $alert->type_alert_id;
        $parms = array("IdRegistry" =>$registryId, "IdAlert" =>$alert->id);
        $newAlert->params =json_encode($parms);
        if ($this->save($newAlert)) {
            Log::write('info', 'The alert added', ['alert' => $newAlert->id]);
            $result= $newAlert->id;
            return $result;
        }else{
            Log::write('error', 'An error ocurred adding alert');
            $result = false;
        }
    }
}
