<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitorPrices Model
 *
 * @property \App\Model\Table\CompetitorsTable&\Cake\ORM\Association\BelongsTo $Competitors
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\CompetitorPrice newEmptyEntity()
 * @method \App\Model\Entity\CompetitorPrice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitorPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitorPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompetitorPrice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CompetitorPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitorPrice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitorPrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompetitorPrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompetitorPrice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CompetitorPrice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CompetitorPrice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CompetitorPrice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompetitorPricesTable extends Table
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

        $this->setTable('competitor_prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Competitors', [
            'foreignKey' => 'competitor_id',
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
            ->integer('competitor_id')
            ->notEmptyString('competitor_id');

        $validator
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

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
        $rules->add($rules->existsIn('competitor_id', 'Competitors'), ['errorField' => 'competitor_id']);
        $rules->add($rules->existsIn('product_id', 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
    public function minPrice($product_id)
    {
        $idCompetitor = $this->find()
            ->contain('Competitors')
            ->where(['product_id'=> $product_id ])
            ->order(['price'=>'ASC'])
            ->first();
        if($idCompetitor == null){
            $idCompetitor=0;
        }else
            $idCompetitor->toArray();

        return $idCompetitor;
    }
}
