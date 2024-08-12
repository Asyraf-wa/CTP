<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Article newEmptyEntity()
 * @method \App\Model\Entity\Article newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Article> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Article findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Article> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Article saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
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

        $this->setTable('articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior(
            'Tools.Slugged',
            ['label' => 'title', 'unique' => true, 'mode' => 'ascii', 'field' => 'slug']
        );

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'poster' => [
                'fields' => [
                    'dir' => 'poster_dir', // defaults to `dir`
                    //'size' => 'photo_size', // defaults to `size`
                    //'type' => 'photo_type', // defaults to `type`
                ],
                'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{field-value:slug}',
            ],
        ]);

        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->value('title')
            ->value('featured')
            ->value('category_id')
            ->value('publish_on')
            ->value('publish_from')
            ->value('publish_to')
            //->value('tag')
            ->add('search', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'fields' => ['title'],
            ])
            //->add('publish_on', 'Search.Compare', [
            //	'fields' => [$this->aliasField('publish_on')],
            //	'operator' => '>='
            //])
            ->add('publish_from', 'Search.Compare', [
                'fields' => [$this->aliasField('publish_on')],
                'operator' => '>='
            ])
            ->add('publish_to', 'Search.Compare', [
                'fields' => [$this->aliasField('publish_on')],
                'operator' => '<='
            ])
            ->callback('tag', [
                'callback' => function (Query $query, array $args, $manager) {
                    $query->find('tagged', ['slug' => $args['tag']]);
                }
            ]);

        $this->addBehavior('Tags.Tag', ['taggedCounter' => false]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->addBehavior('AuditStash.AuditLog');
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
            ->notEmptyString('user_id');

        $validator
            ->integer('category_id')
            ->notEmptyString('category_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        $validator
            ->scalar('icon')
            ->allowEmptyString('icon');

        $validator
            ->scalar('poster')
            ->maxLength('poster', 255)
            ->requirePresence('poster', 'create')
            ->notEmptyString('poster');

        $validator
            ->scalar('poster_dir')
            ->maxLength('poster_dir', 255)
            ->requirePresence('poster_dir', 'create')
            ->notEmptyString('poster_dir');

        $validator
            ->boolean('featured')
            ->allowEmptyString('featured');

        $validator
            ->integer('hits')
            ->requirePresence('hits', 'create')
            ->notEmptyString('hits');

        $validator
            ->integer('kudos')
            ->requirePresence('kudos', 'create')
            ->notEmptyString('kudos');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->scalar('meta_key')
            ->maxLength('meta_key', 255)
            ->requirePresence('meta_key', 'create')
            ->notEmptyString('meta_key');

        $validator
            ->scalar('meta_description')
            ->requirePresence('meta_description', 'create')
            ->notEmptyString('meta_description');

        $validator
            ->date('publish_on')
            ->requirePresence('publish_on', 'create')
            ->notEmptyDate('publish_on');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}
