<?php
namespace Tools\Model\Behavior;

use Cake\Core\Configure;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Event\Event;
use ArrayObject;
use Cake\Validation\Validator;

/**
 * ConfirmableBehavior allows forms to easily require a checkbox toggled (confirmed).
 * Example: Terms of use on registration forms or some "confirm delete checkbox"
 *
 * Copyright 2011, dereuromark (http://www.dereuromark.de)
 *
 * @link http://github.com/dereuromark/
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @link http://www.dereuromark.de/2011/07/05/introducing-two-cakephp-behaviors/
 */
class ConfirmableBehavior extends Behavior {

	protected $_defaultConfig = [
		'message' => null,
		'field' => 'confirm',
		//'table' => null,
		'validator' => 'default',
	];

	public function __construct(Table $table, array $config = []) {
		parent::__construct($table, $config);

		if (!$this->_config['message']) {
			$this->_config['message'] =  __d('tools', 'Please confirm the checkbox');
		}
	}

	public function buildValidator(Event $event, Validator $validator, $name) {
		$this->build($validator, $name);
	}

	public function build(Validator $validator, $name = 'default') {
		if ($name !== $this->_config['validator']) {
			return;
		}

		$field = $this->_config['field'];
		$message = $this->_config['message'];
		$validator->add($field, 'notBlank', [
				'rule' => function ($value, $context) {
					return !empty($value);
				},
				'message' => $message,
				//'provider' => 'table',
				'requirePresence' => true,
				'allowEmpty' => false,
				'last' => true]
		);
		$validator->requirePresence($field);
		//$validator->allowEmpty($field, false);
	}

}
