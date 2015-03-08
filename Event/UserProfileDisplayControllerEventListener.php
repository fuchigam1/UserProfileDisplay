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
		$Controller = $event->subject();
		if (BcUtil::isAdminSystem()) {
			if ($Controller->request->params['action'] == 'admin_add') {
				$Controller->request->data['UserProfileDisplay'] = array(
					'status' => true,
					'show_post_num' => '5',
					'gravatar_rating' => '0',
				);
			}
		}
	}
	
}
