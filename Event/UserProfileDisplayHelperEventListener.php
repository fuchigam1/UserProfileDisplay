<?php
/**
 * [HelperEventListener] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class UserProfileDisplayHelperEventListener extends BcHelperEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'Form.afterEnd',
		'Form.beforeCreate',
	);
	
/**
 * formAfterEnd
 * ユーザー編集・登録画面にユーザープロフィールディスプレイ指定欄を追加する
 * 
 * @param CakeEvent $event
 * @return string
 */
	public function formAfterEnd (CakeEvent $event) {
		$View = $event->subject();
		if (BcUtil::isAdminSystem()) {
			if ($View->request->params['controller'] == 'users') {
				if ($View->request->params['action'] == 'admin_edit' || $View->request->params['action'] == 'admin_add') {
					if ($event->data['id'] == 'UserAdminEditForm' || $event->data['id'] == 'UserAdminAddForm') {
						$event->data['out'] .= $View->element('UserProfileDisplay.admin/user_profile_display_form');
						return $event->data['out'];
					}
				}
			}
		}
	}
	
/**
 * formBeforeCreate
 * ユーザー編集・登録画面のフォームには 画像保存のための multipart/form-data 指定がないため追加する
 * 
 * @param CakeEvent $event
 */
	public function formBeforeCreate (CakeEvent $event) {
		$View = $event->subject();
		if (BcUtil::isAdminSystem()) {
			if ($View->request->params['controller'] == 'users') {
				if ($View->request->params['action'] == 'admin_edit' || $View->request->params['action'] == 'admin_add') {
					if ($event->data['id'] == 'UserAdminEditForm' || $event->data['id'] == 'UserAdminAddForm') {
						$event->data['options'] = Hash::merge($event->data['options'], array('enctype' => 'multipart/form-data'));
					}
				}
			}
		}
	}
	
}
