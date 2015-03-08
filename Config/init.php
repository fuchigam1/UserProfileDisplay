<?php
/**
 * UserProfileDisplay プラグイン用
 * データベース初期化
 */
$this->Plugin->initDb('plugin', 'UserProfileDisplay');
/**
 * ユーザー情報を元にデータを作成する
 *   ・設定データがないユーザー用のデータのみ作成する
 * 
 */
	App::uses('User', 'Model');
	$UserModel = new User();
	$userDatas = $UserModel->find('list', array('recursive' => -1));
	if ($userDatas) {
		CakePlugin::load('UserProfileDisplay');
		App::uses('UserProfileDisplay', 'UserProfileDisplay.Model');
		$UserProfileDisplayModel = new UserProfileDisplay();
		foreach ($userDatas as $key => $user) {
			$userProfileDisplayData = $UserProfileDisplayModel->findByUserId($key);
			$savaData = array();
			if (!$userProfileDisplayData) {
				$savaData['UserProfileDisplay']['user_id'] = $key;
				$UserProfileDisplayModel->create($savaData);
				$UserProfileDisplayModel->save($savaData, false);
			}
		}
	}
/**
 * 必要フォルダ初期化
 * 
 */
	$filesPath = WWW_ROOT .'files';
	$savePath = $filesPath .DS. 'user_profile_display';
	
	if (is_writable($filesPath) && !is_dir($savePath)){
		mkdir($savePath);
	}
	if (!is_writable($savePath)){
		chmod($savePath, 0777);
	}
