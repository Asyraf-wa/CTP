<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Faqs Model
 *
 * @method \App\Model\Entity\Faq newEmptyEntity()
 * @method \App\Model\Entity\Faq newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Faq> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Faq get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Faq findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Faq patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Faq> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Faq|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Faq saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FaqsTable extends Table
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

        $this->setTable('faqs');
        $this->setDisplayField('category');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('AuditStash.AuditLog');
        $this->addBehavior('Search.Search');
        $this->addBehavior(
            'Tools.Slugged',
            ['label' => 'question', 'unique' => true, 'mode' => 'ascii', 'field' => 'slug']
        );
        $this->searchManager()
            ->value('id')
            ->add('answer', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'fields' => ['answer'],
            ])
            ->add('question', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'fields' => ['question'],
            ])
            ->add('status', 'Search.Value', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'multiValue' => true,
                'multiValueSeparator' => '',
                'comparison' => 'VALUE',
                'fields' => ['status'],
            ])
            ->add('category', 'Search.Value', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'multiValue' => true,
                'multiValueSeparator' => '',
                'comparison' => 'VALUE',
                'fields' => ['category'],
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
            ->scalar('category')
            ->maxLength('category', 100)
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

        $validator
            ->scalar('question')
            ->maxLength('question', 255)
            ->requirePresence('question', 'create')
            ->notEmptyString('question');

        $validator
            ->scalar('answer')
            ->maxLength('answer', 255)
            ->requirePresence('answer', 'create')
            ->notEmptyString('answer');

        return $validator;
    }
}
