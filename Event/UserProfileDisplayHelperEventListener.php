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
		'Form.beforeCreate',
		'Form.afterForm',
	);
	
/**
 * 処理対象アクション
 * 
 * @var array
 */
	private $targetAction = array('admin_edit', 'admin_add');
	
/**
 * 処理対象フォームID
 * 
 * @var array
 */
	private $targetFormId = array('UserAdminEditForm', 'UserAdminAddForm');
	
/**
 * formBeforeCreate
 * ユーザー編集・登録画面のフォームには 画像保存のための multipart/form-data 指定がないため追加する
 * 
 * @param CakeEvent $event
 */
	public function formBeforeCreate (CakeEvent $event) {
		if (!BcUtil::isAdminSystem()) {
			return;
		}
		
		$View = $event->subject();
		if ($View->request->params['controller'] != 'users') {
			return;
		}
		
		if (!in_array($View->request->params['action'], $this->targetAction)) {
			return;
		}
		
		if (in_array($event->data['id'], $this->targetFormId)) {
			$event->data['options'] = Hash::merge($event->data['options'], array('enctype' => 'multipart/form-data'));
		}
	}
	
/**
 * formAfterForm
 * ユーザー編集・登録画面にユーザープロフィールディスプレイ指定欄を追加する
 * 
 * @param CakeEvent $event
 */
	public function formAfterForm (CakeEvent $event) {
		if (!BcUtil::isAdminSystem()) {
			return;
		}
		
		$View = $event->subject();
		if ($View->request->params['controller'] != 'users') {
			return;
		}
		
		if (!in_array($View->request->params['action'], $this->targetAction)) {
			return;
		}
		
		if (in_array($event->data['id'], $this->targetFormId)) {
			echo $View->element('UserProfileDisplay.admin/user_profile_display_form');
		}
	}
	
}
