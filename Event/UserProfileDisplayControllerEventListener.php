<?php
/**
 * [ControllerEventListener] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class UserProfileDisplayControllerEventListener extends BcControllerEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'initialize',
		'Users.beforeRender',
	);
	
/**
 * 処理対象とするアクション
 * 
 * @var array
 */
	private $targetAction = array('admin_edit', 'admin_add');
	
/**
 * initialize
 * UserProfileDisplayヘルパーを追加する
 * 
 * @param CakeEvent $event
 */
	public function initialize(CakeEvent $event) {
		$Controller = $event->subject();
		$Controller->helpers[] = 'UserProfileDisplay.UserProfileDisplay';
	}
	
/**
 * usersBeforeRender
 * ユーザー情報追加画面で実行し、UserProfileDisplayの初期値を設定する
 * 
 * @param CakeEvent $event
 */
	public function usersBeforeRender (CakeEvent $event) {
		if (!BcUtil::isAdminSystem()) {
			return;
		}
		
		$Controller = $event->subject();
		if (!in_array($Controller->request->params['action'], $this->targetAction)) {
			return;
		}
		
		if ($Controller->request->params['action'] == 'admin_add') {
			App::uses('UserProfileDisplay', 'UserProfileDisplay.Model');
			$UserProfileDisplayModel = new UserProfileDisplay();
			$default = $UserProfileDisplayModel->getDefaultValue();
			$Controller->request->data['UserProfileDisplay'] = $default['UserProfileDisplay'];
			return;
		}
		
		if (isset($Controller->request->data['UserProfileDisplay']) && empty($Controller->request->data['UserProfileDisplay'])) {
			App::uses('UserProfileDisplay', 'UserProfileDisplay.Model');
			$UserProfileDisplayModel = new UserProfileDisplay();
			$default = $UserProfileDisplayModel->getDefaultValue();
			$Controller->request->data['UserProfileDisplay'] = $default['UserProfileDisplay'];
		}
	}
	
}
