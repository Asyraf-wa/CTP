<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Publications Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Publication newEmptyEntity()
 * @method \App\Model\Entity\Publication newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Publication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Publication get($primaryKey, $options = [])
 * @method \App\Model\Entity\Publication findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Publication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Publication[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Publication|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Publication saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Publication[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Publication[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Publication[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Publication[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PublicationsTable extends Table
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

        $this->setTable('publications');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Tools.Slugged',
			['label' => 'manuscript_title', 'unique' => true, 'mode' => 'ascii', 'field' => 'slug']
		);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
			'attachment' => [
				'fields' => [
					'dir' => 'attachment_dir', // defaults to `dir`
				],
            'keepFilesOnDelete' => false,
			'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{field-value:slug}',
			],
		]);

        $this->addBehavior('Search.Search');
        $this->searchManager()
			->value('journal_name')
			->value('doi')
			->value('serial') //issn/isbn
			->value('manuscript_title')
			->value('keywords')
			->value('authors')
			->value('sponsor')
			->value('abstract')
			->value('year')
			->value('status')
			->value('pointer') //wos/scopus/mycite etc
				//main search box covers title, call no, av no and summary
                //'','status',''
				->add('q', 'Search.Like', [ 
					'before' => true,
					'after' => true,
					'fields' => ['manuscript_title','journal_name','doi','authors','serial','keywords','sponsor','abstract'], // field yang nak retrieve
				])
				->add('y', 'Search.Like', [
					'before' => true,
					'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '',
					'comparison' => 'LIKE',
					'fields' => ['year'],
				])
				->add('pointer', 'Search.Like', [
					'before' => true,
					'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '',
					'comparison' => 'LIKE',
					'fields' => ['pointer'],
				])
				->add('paper_type', 'Search.Like', [
					'before' => true,
					'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '',
					'comparison' => 'LIKE',
					'fields' => ['paper_type'],
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
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmptyString('year');

        $validator
            ->scalar('manuscript_title')
            ->maxLength('manuscript_title', 255)
            ->requirePresence('manuscript_title', 'create')
            ->notEmptyString('manuscript_title');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 255)
            ->requirePresence('keywords', 'create')
            ->notEmptyString('keywords');

        $validator
            ->scalar('authors')
            ->maxLength('authors', 255)
            ->requirePresence('authors', 'create')
            ->notEmptyString('authors');

        $validator
            ->scalar('abstract')
            ->requirePresence('abstract', 'create')
            ->notEmptyString('abstract');

        $validator
            ->scalar('pointer')
            ->maxLength('pointer', 255)
            ->requirePresence('pointer', 'create')
            ->notEmptyString('pointer');



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
