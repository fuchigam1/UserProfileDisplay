<?php

/**
 * [Controller] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class UserProfileDisplayAppController extends BcPluginAppController
{

	/**
	 * ヘルパー
	 *
	 * @var array
	 */
	public $helpers = array('BcForm', 'BcUpload');

	/**
	 * サブメニューエレメント
	 *
	 * @var array
	 */
	public $subMenuElements = array('user_profile_display');

	/**
	 * ぱんくずナビ
	 *
	 * @var string
	 */
	public $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'プロフィール表示プラグイン', 'url' => array('plugin' => 'user_profile_display', 'controller' => 'user_profile_displays', 'action' => 'index'))
	);

	/**
	 * 管理画面タイトル
	 *
	 * @var string
	 */
	public $adminTitle = 'プロフィール表示';

	/**
	 * 多対多の処理対象のモデル名
	 * 
	 * @var array
	 */
	public $modelName = array();

	/**
	 * sort フィールドで並び替えを行うモデル名
	 * 
	 * @var array
	 */
	public $sortModelName = array();

	/**
	 * beforeFilter
	 *
	 * @return	void
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
			//'order'	=> $this->modelClass .'.id DESC',
			'limit'		 => $this->passedArgs['num']
		);
		$this->set('datas', $this->paginate($this->modelClass));

		if ($this->RequestHandler->isAjax() || !empty($this->request->query['ajax'])) {
			Configure::write('debug', 0);
			$this->render('ajax_index');
			return;
		}
	}

	/**
	 * [ADMIN] 追加
	 * 
	 */
	public function admin_add()
	{
		if ($this->request->data) {
			$this->{$this->modelClass}->create($this->request->data);
			if ($this->{$this->modelClass}->save()) {
				$message = $this->adminTitle . '「' . $this->request->data[$this->modelClass]['name'] . '」を追加しました。';
				$this->setMessage($message, false, true);
				$this->redirect(array('action' => 'index'));
			} else {
				$message = '入力エラーです。内容を修正してください。';
				$this->setMessage($message, true);
			}
		} else {
			$this->request->data = $this->{$this->modelClass}->getDefaultValue();
		}

		$this->pageTitle = $this->adminTitle . '新規登録';
		$this->render('form');
	}

	/**
	 * [ADMIN] 編集
	 * 
	 * @param int $id
	 */
	public function admin_edit($id = null)
	{
		if (!$id) {
			$this->setMessage('無効な処理です。', true);
			$this->redirect(array('action' => 'index'));
		}
		if (empty($this->request->data)) {
			$this->request->data			 = $this->{$this->modelClass}->getDefaultValue();
			$this->{$this->modelClass}->id	 = $id;
			$this->request->data			 = $this->{$this->modelClass}->read();
		} else {
			$this->{$this->modelClass}->set($this->request->data);
			if ($this->{$this->modelClass}->save($this->request->data)) {

				// メッセージ用にデータを取得
				$data	 = $this->{$this->modelClass}->read(null, $id);
				$message = $this->adminTitle . '「' . h($data[$this->modelClass]['name']) . '」を更新しました。';
				$this->setMessage($message, false, true);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setMessage('入力エラーです。内容を修正して下さい。', true);
			}
		}
		$this->render('form');
	}

	/**
	 * [ADMIN] 削除
	 *
	 * @param int $id
	 */
	public function admin_delete($id = null)
	{
		if (!$id) {
			$this->setMessage('無効な処理です。', true);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->{$this->modelClass}->delete($id)) {
			$message = 'NO.' . $id . 'のデータを削除しました。';
			$this->setMessage($message);
			$this->redirect(array('action' => 'index'));
		} else {
			$this->setMessage('データベース処理中にエラーが発生しました。', true);
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * [ADMIN] 削除処理　(ajax)
	 *
	 * @param int $id
	 */
	public function admin_ajax_delete($id = null)
	{
		if (!$id) {
			$this->ajaxError(500, '無効な処理です。');
		}
		// 削除実行
		if ($this->_delete($id)) {
			clearViewCache();
			exit(true);
		}
		exit();
	}

	/**
	 * データを削除する
	 * 
	 * @param int $id
	 * @return boolean 
	 */
	protected function _delete($id)
	{
		// メッセージ用にデータを取得
		$data = $this->{$this->modelClass}->read(null, $id);
		// 削除実行
		if ($this->{$this->modelClass}->delete($id)) {
			$message = $this->adminTitle . 'のID: ' . $data[$this->modelClass]['id'] . ' を削除しました。';
			$this->{$this->modelClass}->saveDbLog($message);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [ADMIN] 無効状態にする
	 * 
	 * @param int $id
	 */
	public function admin_unpublish($id)
	{
		if (!$id) {
			$this->setMessage('この処理は無効です。', true);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->_changeStatus($id, false)) {
			// メッセージ用にデータを取得
			$data	 = $this->{$this->modelClass}->read(null, $id);
			$message = $this->adminTitle . 'のID: ' . $data[$this->modelClass]['id'] . ' を「無効」状態に変更しました。';
			$this->setMessage($message);
			$this->redirect(array('action' => 'index'));
		}
		$this->setMessage('処理に失敗しました。', true);
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * [ADMIN] 有効状態にする
	 * 
	 * @param int $id
	 */
	public function admin_publish($id)
	{
		if (!$id) {
			$this->setMessage('この処理は無効です。', true);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->_changeStatus($id, true)) {
			// メッセージ用にデータを取得
			$data	 = $this->{$this->modelClass}->read(null, $id);
			$message = $this->adminTitle . 'のID: ' . $data[$this->modelClass]['id'] . ' を「有効」状態に変更しました。';
			$this->setMessage($message);
			$this->redirect(array('action' => 'index'));
		}
		$this->setMessage('処理に失敗しました。', true);
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * [ADMIN] 無効状態にする（AJAX）
	 * 
	 * @param int $id
	 */
	public function admin_ajax_unpublish($id)
	{
		if (!$id) {
			$this->ajaxError(500, '無効な処理です。');
		}
		if ($this->_changeStatus($id, false)) {
			clearViewCache();
			exit(true);
		} else {
			$this->ajaxError(500, $this->{$this->modelClass}->validationErrors);
		}
		exit();
	}

	/**
	 * [ADMIN] 有効状態にする（AJAX）
	 * 
	 * @param int $id
	 */
	public function admin_ajax_publish($id)
	{
		if (!$id) {
			$this->ajaxError(500, '無効な処理です。');
		}
		if ($this->_changeStatus($id, true)) {
			clearViewCache();
			exit(true);
		} else {
			$this->ajaxError(500, $this->{$this->modelClass}->validationErrors);
		}
		exit();
	}

	/**
	 * ステータスを変更する
	 * 
	 * @param int $id
	 * @param boolean $status
	 * @return boolean 
	 */
	protected function _changeStatus($id, $status)
	{
		$data								 = $this->{$this->modelClass}->find('first', array(
			'conditions' => array('id' => $id),
			'recursive'	 => -1
		));
		$data[$this->modelClass]['status']	 = $status;
		if ($status) {
			$data[$this->modelClass]['status'] = true;
		} else {
			$data[$this->modelClass]['status'] = false;
		}
		$this->{$this->modelClass}->set($data);
		if ($this->{$this->modelClass}->save()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [ADMIN] コピー (ajax)
	 * 
	 * @param int $id
	 */
	public function admin_ajax_copy($id = null)
	{
		$result = $this->{$this->modelClass}->copy($id);
		if ($result) {
			if (in_array($this->modelClass, $this->modelName)) {
				// 多対多情報を取得するため読み込みなおす
				$this->{$this->modelClass}->recursive = 1;
			}
			$data = $this->{$this->modelClass}->read();
			$this->setViewConditions($this->modelClass, array('action' => 'admin_index'));
			$this->set('data', $data);
			clearViewCache();
		} else {
			$this->ajaxError(500, $this->{$this->modelClass}->validationErrors);
		}
		if (in_array($this->modelClass, $this->sortModelName)) {
			if (!isset($this->passedArgs['sortmode'])) {
				$this->passedArgs['sortmode'] = false;
			}
			$this->set('sortmode', $this->passedArgs['sortmode']);
		}
	}

	/**
	 * [ADMIN] 並び替えを更新する（AJAX）
	 *
	 * @return boolean
	 */
	public function admin_ajax_update_sort()
	{
		if ($this->request->data) {
			$this->setViewConditions($this->modelClass, array('action' => 'admin_index'));
			$conditions = $this->_createAdminIndexConditions($this->request->data);
			if ($this->{$this->modelClass}->changeSort($this->request->data['Sort']['id'], $this->request->data['Sort']['offset'], $conditions)) {
				clearViewCache();
				clearDataCache();
				echo true;
			} else {
				$this->ajaxError(500, '一度リロードしてから再実行してみてください。');
			}
		} else {
			$this->ajaxError(500, '無効な処理です。');
		}
		exit();
	}

	/**
	 * [ADMIN] 並び順を上げる
	 * 
	 * @param int $id
	 */
	public function admin_move_up($id)
	{
		$this->pageTitle = $this->adminTitle . '並び順繰り上げ';

		if (!$id) {
			$this->setMessage('無効なIDです。', true);
			$this->redirect(array('action' => 'index'));
		}

		if ($this->{$this->modelClass}->Behaviors->enabled('List')) {
			if ($this->{$this->modelClass}->moveUp($id)) {
				$message = $this->pageTitle . 'ました。';
				$this->setMessage($message, false, false);
				clearAllCache();
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setMessage('データベース処理中にエラーが発生しました。', true);
			}
		} else {
			$this->setMessage('ListBehaviorが無効のモデルです。', true);
		}
		$this->render(false);
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * [ADMIN] 並び順を下げる
	 * 
	 * @param int $id 
	 */
	public function admin_move_down($id)
	{
		$this->pageTitle = $this->adminTitle . '並び順を繰り下げ';

		if (!$id) {
			$this->setMessage('無効なIDです。', true);
			$this->redirect(array('action' => 'index'));
		}

		if ($this->{$this->modelClass}->Behaviors->enabled('List')) {
			if ($this->{$this->modelClass}->moveDown($id)) {
				$message = $this->pageTitle . 'ました。';
				$this->setMessage($message, false, false);
				clearAllCache();
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setMessage('データベース処理中にエラーが発生しました。', true);
			}
		} else {
			$this->setMessage('ListBehaviorが無効のモデルです。', true);
		}
		$this->render(false);
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * [ADMIN] TreeBehavior利用中のデータに lft,rght を割り振る
	 * 
	 */
	public function admin_reorder()
	{
		if ($this->{$this->modelClass}->Behaviors->enabled('Tree')) {
			if ($this->{$this->modelClass}->recover()) {
				$message = $this->modelClass . 'データに lft,rght を割り振りました。';
				$this->setMessage($message, false, true);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setMessage('データベース処理中にエラーが発生しました。', true);
			}
		} else {
			$this->setMessage('TreeBehaviorが無効のモデルです。', true);
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * [ADMIN] ListBehavior利用中のデータ並び順を割り振る
	 * 
	 * @return void
	 */
	public function admin_reposition()
	{
		if ($this->{$this->modelClass}->Behaviors->enabled('List')) {
			if ($this->{$this->modelClass}->fixListOrder()) {
				clearAllCache();
				$message = $this->modelClass . 'データに並び順（position）を割り振りました。';
				$this->setMessage($message, false, true);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setMessage('データベース処理中にエラーが発生しました。', true);
			}
		} else {
			$this->setMessage('ListBehaviorが無効のモデルです。', true);
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * 一覧の表示用データをセットする
	 * 
	 */
	protected function _setAdminIndexViewData()
	{
		$user		 = $this->BcAuth->user();
		$allowOwners = array();
		if (!empty($user)) {
			$allowOwners = array('', $user['user_group_id']);
		}
		if (!isset($this->passedArgs['sortmode'])) {
			$this->passedArgs['sortmode'] = false;
		}
		$this->set('allowOwners', $allowOwners);
		$this->set('sortmode', $this->passedArgs['sortmode']);
	}

	/**
	 * [ADMIN] CSVファイルをダウンロードする
	 * 
	 */
	public function admin_download_csv()
	{
		$default	 = array();
		// レコード抽出条件
		$this->setViewConditions($this->modelClass, array(
			'default'	 => $default,
			'action'	 => 'admin_index',
		));
		$conditions	 = $this->_createAdminIndexConditions($this->request->data);
		$datas		 = $this->{$this->modelClass}->find('all', array(
			'conditions' => $conditions,
			'recursive'	 => -1
		));
		$this->set('datas', $datas);
		$this->set('csvFileName', Inflector::underscore($this->modelClass));
	}

	/**
	 * 検索キーワードを分解し配列に変換する
	 *
	 * @param string $query
	 * @return array
	 */
	protected function parseQuery($query = '')
	{
		$query = str_replace('　', ' ', $query);
		if (strpos($query, ' ') !== false) {
			$query = explode(' ', $query);
		} else {
			$query = array($query);
		}
		return h($query);
	}

}
