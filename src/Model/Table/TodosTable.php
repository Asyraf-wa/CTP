<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Todos Model
 *
 * @method \App\Model\Entity\Todo newEmptyEntity()
 * @method \App\Model\Entity\Todo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Todo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Todo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Todo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Todo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Todo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Todo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Todo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Todo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Todo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Todo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Todo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TodosTable extends Table
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

        $this->setTable('todos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('task')
            ->maxLength('task', 255)
            ->requirePresence('task', 'create')
            ->notEmptyString('task');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}