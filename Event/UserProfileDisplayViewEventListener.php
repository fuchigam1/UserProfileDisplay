<?php

/**
 * [ViewEventListener] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class UserProfileDisplayViewEventListener extends BcViewEventListener {

	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'Users.afterElement',
	);

	/**
	 * afterElement
	 * - ユーザー一覧画面に、プロフィール表示一覧へのリンクを追加する
	 * 
	 * @param CakeEvent $event
	 */
	public function usersAfterElement(CakeEvent $event) {
		if (!BcUtil::isAdminSystem()) {
			return;
		}

		$View = $event->subject();
		if ($event->data['name'] === 'submenus/users') {
			$event->data['out'] = $event->data['out'] . $View->element('UserProfileDisplay.submenus/user_profile_display_sort');
		}

		return;
	}

}
