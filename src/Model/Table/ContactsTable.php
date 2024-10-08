<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contacts Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Contact newEmptyEntity()
 * @method \App\Model\Entity\Contact newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Contact> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contact get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Contact findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Contact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Contact> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contact|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Contact saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('contacts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior(
            'Tools.Slugged',
            ['label' => 'subject', 'unique' => true, 'mode' => 'ascii', 'field' => 'slug']
        );

        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->value('ticket')
            ->value('status')
            ->value('subject')
            ->add('status', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'multiValue' => true,
                'multiValueSeparator' => '',
                'comparison' => 'LIKE',
                'fields' => ['status'],
            ])
            ->add('from', 'Search.Compare', [
                'fields' => [$this->aliasField('created')],
                'operator' => '>='
            ])
            ->add('to', 'Search.Compare', [
                'fields' => [$this->aliasField('created')],
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
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->scalar('ticket')
            ->maxLength('ticket', 255)
            ->requirePresence('ticket', 'create')
            ->notEmptyString('ticket');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 255)
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->scalar('category')
            ->maxLength('category', 255)
            ->allowEmptyString('category');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('notes')
            ->requirePresence('notes', 'create')
            ->notEmptyString('notes');

        $validator
            ->scalar('note_admin')
            ->allowEmptyString('note_admin');

        $validator
            ->scalar('ip')
            ->maxLength('ip', 255)
            ->requirePresence('ip', 'create')
            ->notEmptyString('ip');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->notEmptyString('status');

        $validator
            ->boolean('is_replied')
            ->requirePresence('is_replied', 'create')
            ->notEmptyString('is_replied');

        $validator
            ->dateTime('respond_date_time')
            ->allowEmptyDateTime('respond_date_time');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->allowEmptyString('slug');

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
