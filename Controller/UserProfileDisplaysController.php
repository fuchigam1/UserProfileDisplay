<?php

/**
 * [Controller] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
App::uses('UserProfileDisplayApp', 'UserProfileDisplay.Controller');

class UserProfileDisplaysController extends UserProfileDisplayAppController
{

	/**
	 * ControllerName
	 * 
	 * @var string
	 */
	public $name = 'UserProfileDisplays';

	/**
	 * Model
	 * 
	 * @var array
	 */
	public $uses = array(
		'UserProfileDisplay.UserProfileDisplay',
	);

	/**
	 * 管理画面タイトル
	 *
	 * @var string
	 */
	public $adminTitle = 'プロフィール表示';

	/**
	 * beforeFilter
	 *
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	/**
	 * [ADMIN] 一覧表示
	 * 
	 */
	public function admin_index()
	{
		$default = array('named' => array(
				'num'		 => $this->siteConfigs['admin_list_num'],
				'sortmode'	 => 0)
		);
		$this->setViewConditions($this->modelClass, array('default' => $default));

		$conditions		 = $this->_createAdminIndexConditions($this->request->data);
		$this->paginate	 = array(
			'conditions' => $conditions,
			'fields'	 => array(),
			'order'		 => $this->modelClass . '.position ASC',
			'limit'		 => $this->passedArgs['num']
		);
		$this->set('datas', $this->paginate($this->modelClass));

		if ($this->RequestHandler->isAjax() || !empty($this->request->query['ajax'])) {
			Configure::write('debug', 0);
			$this->render('ajax_index');
			return;
		}

		$this->pageTitle = $this->adminTitle . '一覧';
		$this->search	 = 'user_profile_displays_index';
	}

	/**
	 * [ADMIN] ページ一覧用の検索条件を生成する
	 *
	 * @param array $data
	 * @return array $conditions
	 */
	protected function _createAdminIndexConditions($data)
	{
		$conditions	 = array();
		$name		 = '';

		if (isset($data['UserProfileDisplay']['name'])) {
			$name = $data['UserProfileDisplay']['name'];
		}

		unset($data['_Token']);
		unset($data['UserProfileDisplay']['name']);

		unset($data['UserProfileDisplay']['num']);
		unset($data['UserProfileDisplay']['page']);

		// 条件指定のないフィールドを解除
		foreach ($data['UserProfileDisplay'] as $key => $value) {
			if ($value === '') {
				unset($data['UserProfileDisplay'][$key]);
			}
		}
		if ($data['UserProfileDisplay']) {
			$conditions = $this->postConditions($data);
		}

		// １つの入力指定から複数フィールド検索指定
		if ($name) {
			$conditions[] = array(
				'OR' => array(
					array('UserProfileDisplay' . '.name LIKE' => '%' . $name . '%'),
				),
			);
		}

		if ($conditions) {
			return $conditions;
		} else {
			return array();
		}
	}

}
