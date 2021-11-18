<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Authentication\PasswordHasher\DefaultPasswordHasher;
//use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \App\Model\Table\UserGroupsTable&\Cake\ORM\Association\BelongsTo $UserGroups
 * @property \App\Model\Table\AnnouncementsTable&\Cake\ORM\Association\HasMany $Announcements
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\ContactsTable&\Cake\ORM\Association\HasMany $Contacts
 * @property \App\Model\Table\EmailsTable&\Cake\ORM\Association\HasMany $Emails
 * @property \App\Model\Table\RecipientsTable&\Cake\ORM\Association\HasMany $Recipients
 * @property \App\Model\Table\UserEmailRecipientsTable&\Cake\ORM\Association\HasMany $UserEmailRecipients
 * @property \App\Model\Table\UserEmailsTable&\Cake\ORM\Association\HasMany $UserEmails
 * @property \App\Model\Table\UserLogsTable&\Cake\ORM\Association\HasMany $UserLogs
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->addBehavior('Tools.Slugged',
			['label' => 'username', 'unique' => true, 'mode' => 'ascii', 'field' => 'slug']
		);
		
		$this->addBehavior('Josegonzalez/Upload.Upload', [
			'avatar' => [
				'fields' => [
					'dir' => 'avatar_dir', // defaults to `dir`
					//'size' => 'photo_size', // defaults to `size`
					//'type' => 'photo_type', // defaults to `type`
				],
			'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{field-value:slug}',
			],
		]);

        $this->belongsTo('UserGroups', [
            'foreignKey' => 'user_group_id',
        ]);
        $this->hasMany('Announcements', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Blogs', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Contacts', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Emails', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('UserLogs', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Fitnesses', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Pains', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'user_id',
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
            ->scalar('fullname')
            ->maxLength('fullname', 255)
            ->requirePresence('fullname', 'create')
            ->notEmptyString('fullname');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        return $validator;
    }
	
	public function validationPassword($validator) {
		$validator
			->add('current_password', [
				'notBlank'=>[
					'rule'=>'notBlank',
					'message'=>__('Please enter old password'),
					'last'=>true
				],
			])
			
			->add('current_password',
				'custom',[
					'rule'=>  function($value, $context){
						$user = $this->get($context['data']['id']);
							if ($user) {
								if ((new DefaultPasswordHasher)->check($value, $user->password)) {
									return true;
								}
							}
						return false;
					},
					'message'=>'The old password does not match the current password!',
			])


			->add('password', [
				'notBlank'=>[
					'rule'=>'notBlank',
					'message'=>__('Please enter password'),
					'last'=>true
				],
				'mustBeLonger'=>[
					'rule'=>['minLength', 6],
					'message'=>__('Password must be greater than 5 characters'),
					'last'=>true
				]
			])

			->add('cpassword', [
				'notBlank'=>[
					'rule'=>'notBlank',
					'message'=>__('Please enter password'),
					'last'=>true
				],
				'mustMatch'=>[
					'rule'=>'checkForSamePassword',
					'provider'=>'table',
					'message'=>__('Both password must match')
				]
			]);

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->existsIn(['user_group_id'], 'UserGroups'), ['errorField' => 'user_group_id']);

        return $rules;
    }
	
	public function checkForSamePassword($value, $context) {
		if(!empty($value) && $value != $context['data']['password']) {
			return false;
		}
		return true;
	}
}
