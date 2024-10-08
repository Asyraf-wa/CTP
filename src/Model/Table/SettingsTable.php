<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 *
 * @method \App\Model\Entity\Setting newEmptyEntity()
 * @method \App\Model\Entity\Setting newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Setting> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setting get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Setting findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Setting> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setting|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Setting saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Setting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setting>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setting> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setting>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setting> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SettingsTable extends Table
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

        $this->setTable('settings');
        $this->setDisplayField('system_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('system_name')
            ->maxLength('system_name', 255)
            ->requirePresence('system_name', 'create')
            ->notEmptyString('system_name');

        $validator
            ->scalar('system_abbr')
            ->maxLength('system_abbr', 255)
            ->requirePresence('system_abbr', 'create')
            ->notEmptyString('system_abbr');

        $validator
            ->scalar('system_slogan')
            ->maxLength('system_slogan', 255)
            ->requirePresence('system_slogan', 'create')
            ->notEmptyString('system_slogan');

        $validator
            ->scalar('organization_name')
            ->maxLength('organization_name', 255)
            ->requirePresence('organization_name', 'create')
            ->notEmptyString('organization_name');

        $validator
            ->scalar('domain_name')
            ->maxLength('domain_name', 255)
            ->requirePresence('domain_name', 'create')
            ->notEmptyString('domain_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('notification_email')
            ->maxLength('notification_email', 50)
            ->requirePresence('notification_email', 'create')
            ->notEmptyString('notification_email');

        $validator
            ->scalar('meta_title')
            ->maxLength('meta_title', 255)
            ->requirePresence('meta_title', 'create')
            ->notEmptyString('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->maxLength('meta_keyword', 255)
            ->requirePresence('meta_keyword', 'create')
            ->notEmptyString('meta_keyword');

        $validator
            ->scalar('meta_subject')
            ->maxLength('meta_subject', 255)
            ->requirePresence('meta_subject', 'create')
            ->notEmptyString('meta_subject');

        $validator
            ->scalar('meta_copyright')
            ->maxLength('meta_copyright', 255)
            ->requirePresence('meta_copyright', 'create')
            ->notEmptyString('meta_copyright');

        $validator
            ->scalar('meta_desc')
            ->maxLength('meta_desc', 255)
            ->requirePresence('meta_desc', 'create')
            ->notEmptyString('meta_desc');

        $validator
            ->scalar('timezone')
            ->maxLength('timezone', 100)
            ->requirePresence('timezone', 'create')
            ->notEmptyString('timezone');

        $validator
            ->scalar('author')
            ->maxLength('author', 255)
            ->requirePresence('author', 'create')
            ->notEmptyString('author');

        $validator
            ->boolean('site_status')
            ->requirePresence('site_status', 'create')
            ->notEmptyString('site_status');

        $validator
            ->boolean('user_reg')
            ->requirePresence('user_reg', 'create')
            ->notEmptyString('user_reg');

        $validator
            ->boolean('config_2')
            ->requirePresence('config_2', 'create')
            ->notEmptyString('config_2');

        $validator
            ->boolean('config_3')
            ->requirePresence('config_3', 'create')
            ->notEmptyString('config_3');

        $validator
            ->scalar('version')
            ->maxLength('version', 255)
            ->requirePresence('version', 'create')
            ->notEmptyString('version');

        $validator
            ->scalar('private_key_from_recaptcha')
            ->maxLength('private_key_from_recaptcha', 255)
            ->allowEmptyString('private_key_from_recaptcha');

        $validator
            ->scalar('public_key_from_recaptcha')
            ->maxLength('public_key_from_recaptcha', 255)
            ->allowEmptyString('public_key_from_recaptcha');

        $validator
            ->scalar('banned_username')
            ->allowEmptyString('banned_username');

        $validator
            ->scalar('telegram_bot_token')
            ->maxLength('telegram_bot_token', 255)
            ->allowEmptyString('telegram_bot_token');

        $validator
            ->scalar('telegram_chatid')
            ->maxLength('telegram_chatid', 255)
            ->allowEmptyString('telegram_chatid');

        $validator
            ->scalar('hcaptcha_sitekey')
            ->maxLength('hcaptcha_sitekey', 255)
            ->allowEmptyString('hcaptcha_sitekey');

        $validator
            ->scalar('hcaptcha_secretkey')
            ->maxLength('hcaptcha_secretkey', 255)
            ->allowEmptyString('hcaptcha_secretkey');

        $validator
            ->scalar('notification')
            ->requirePresence('notification', 'create')
            ->notEmptyString('notification');

        $validator
            ->boolean('notification_status')
            ->requirePresence('notification_status', 'create')
            ->notEmptyString('notification_status');

        $validator
            ->date('notification_date')
            ->allowEmptyDate('notification_date');

        $validator
            ->scalar('ribbon_title')
            ->maxLength('ribbon_title', 20)
            ->requirePresence('ribbon_title', 'create')
            ->notEmptyString('ribbon_title');

        $validator
            ->scalar('ribbon_link')
            ->maxLength('ribbon_link', 255)
            ->requirePresence('ribbon_link', 'create')
            ->notEmptyString('ribbon_link');

        $validator
            ->boolean('ribbon_status')
            ->requirePresence('ribbon_status', 'create')
            ->notEmptyString('ribbon_status');

        return $validator;
    }
}
