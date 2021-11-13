<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PainsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
		
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
	}
}