<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fitnesses Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Fitness newEmptyEntity()
 * @method \App\Model\Entity\Fitness newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fitness[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fitness get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fitness findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fitness patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fitness[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fitness|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fitness saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fitness[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fitness[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fitness[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fitness[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FitnessesTable extends Table
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

        $this->setTable('fitnesses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->addBehavior('Search.Search');
		
		$this->searchManager()
			->value('type')
			->value('registered_from')
			->value('registered_to')
			//->value('tag')
			->add('search', 'Search.Like', [
				'before' => true,
				'after' => true,
				'multiValue' => true,
				'fieldMode' => 'OR',
				'comparison' => 'LIKE',
				'wildcardAny' => '*',
				'wildcardOne' => '?',
				'fields' => ['type'],
			])
			->add('registered_from', 'Search.Compare', [
				'fields' => [$this->aliasField('registered_on')],
				'operator' => '>='
			])
			->add('registered_to', 'Search.Compare', [
				'fields' => [$this->aliasField('registered_on')],
				'operator' => '<='
			]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
    /*     $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');
 */
        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->integer('counter')
            ->requirePresence('counter', 'create')
            ->notEmptyString('counter');

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 255)
            ->requirePresence('latitude', 'create')
            ->notEmptyString('latitude');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 255)
            ->requirePresence('longitude', 'create')
            ->notEmptyString('longitude');
/* 
        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->dateTime('registered_on')
            ->requirePresence('registered_on', 'create')
            ->notEmptyDateTime('registered_on');
 */
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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
