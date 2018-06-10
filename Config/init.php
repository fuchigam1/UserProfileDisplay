<?php
/**
 * UserProfileDisplay プラグイン用
 * データベース初期化
 */
$this->Plugin->initDb('UserProfileDisplay');
/**
 * 必要フォルダ初期化
 * 
 */
$filesPath	 = WWW_ROOT . 'files';
$savePath	 = $filesPath . DS . 'user_profile_display';

if (is_writable($filesPath) && !is_dir($savePath)) {
	mkdir($savePath);
}
if (!is_writable($savePath)) {
	chmod($savePath, 0777);
}
