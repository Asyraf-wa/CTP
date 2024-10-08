<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuditLogs Model
 *
 * @method \App\Model\Entity\AuditLog newEmptyEntity()
 * @method \App\Model\Entity\AuditLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AuditLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AuditLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AuditLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AuditLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AuditLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AuditLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AuditLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AuditLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AuditLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AuditLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AuditLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AuditLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AuditLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AuditLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AuditLog> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AuditLogsTable extends Table
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

        $this->setTable('audit_logs');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->value('id')
            ->value('primary_key')
            ->value('source')
            //->value('status')
            ->add('type', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'multiValue' => true,
                'multiValueSeparator' => '',
                'comparison' => 'LIKE',
                'fields' => ['type'],
            ])
            ->add('status', 'Search.Value', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'multiValue' => true,
                'multiValueSeparator' => '',
                'comparison' => 'LIKE',
                'fields' => ['status'],
            ])
            ->add('log_from', 'Search.Compare', [
                'fields' => [$this->aliasField('created')],
                'operator' => '>='
            ])
            ->add('log_to', 'Search.Compare', [
                'fields' => [$this->aliasField('created')],
                'operator' => '<='
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
            ->uuid('transaction')
            ->requirePresence('transaction', 'create')
            ->notEmptyString('transaction');

        $validator
            ->scalar('type')
            ->maxLength('type', 7)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->nonNegativeInteger('primary_key')
            ->allowEmptyString('primary_key');

        $validator
            ->scalar('source')
            ->maxLength('source', 255)
            ->requirePresence('source', 'create')
            ->notEmptyString('source');

        $validator
            ->scalar('parent_source')
            ->maxLength('parent_source', 255)
            ->allowEmptyString('parent_source');

        $validator
            ->scalar('original')
            ->maxLength('original', 16777215)
            ->allowEmptyString('original');

        $validator
            ->scalar('changed')
            ->maxLength('changed', 16777215)
            ->allowEmptyString('changed');

        $validator
            ->scalar('meta')
            ->maxLength('meta', 16777215)
            ->allowEmptyString('meta');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->allowEmptyString('slug');

        return $validator;
    }
}
