<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TagsTags Model
 *
 * @method \App\Model\Entity\TagsTag newEmptyEntity()
 * @method \App\Model\Entity\TagsTag newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TagsTag> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TagsTag get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TagsTag findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TagsTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TagsTag> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TagsTag|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TagsTag saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TagsTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TagsTag>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TagsTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TagsTag> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TagsTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TagsTag>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TagsTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TagsTag> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TagsTagsTable extends Table
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

        $this->setTable('tags_tags');
        $this->setDisplayField('label');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('AuditStash.AuditLog');
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->value('id')
            ->add('search', 'Search.Like', [
                //'before' => true,
                //'after' => true,
                'fieldMode' => 'OR',
                'multiValue' => true,
                'multiValueSeparator' => '|',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'fields' => ['id'],
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
        $rules->add($rules->isUnique(['slug', 'namespace'], ['allowMultipleNulls' => true]), ['errorField' => 'slug']);

        return $rules;
    }
}