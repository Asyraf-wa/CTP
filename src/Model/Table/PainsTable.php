<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pains Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Pain newEmptyEntity()
 * @method \App\Model\Entity\Pain newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Pain[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pain get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pain findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Pain patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pain[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pain|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pain saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pain[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pain[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pain[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pain[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PainsTable extends Table
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

        $this->setTable('pains');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->addBehavior('Search.Search');

		$this->searchManager()
			->value('type')
			->value('feel')
			->value('pain_point')
			->add('search', 'Search.Like', [ 
				'before' => true,
				'after' => true,
				'fieldMode' => 'OR',
				'comparison' => 'LIKE',
				'wildcardAny' => '*',
				'wildcardOne' => '?',
				'fields' => ['type'],
			])
			->add('publish_from', 'Search.Compare', [
				'fields' => [$this->aliasField('publish_from')],
				'operator' => '>='
			])
			->add('publish_to', 'Search.Compare', [
				'fields' => [$this->aliasField('publish_to')],
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
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->integer('feel')
            ->requirePresence('feel', 'create')
            ->notEmptyString('feel');

        $validator
            ->scalar('medication')
            ->requirePresence('medication', 'create')
            ->notEmptyString('medication');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->scalar('pain_point')
            ->maxLength('pain_point', 255)
            ->requirePresence('pain_point', 'create')
            ->notEmptyString('pain_point');

        $validator
            ->scalar('cause')
            ->requirePresence('cause', 'create')
            ->notEmptyString('cause');

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
