<?php 
class UserProfileDisplaysSchema extends CakeSchema {

	public $file = 'user_profile_displays.php';

	public $connection = 'plugin';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $user_profile_displays = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'ユーザーID'),
		'position' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '並び順'),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => '状態'),
		'show_name' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2, 'unsigned' => false, 'comment' => '公開側表示名'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => '表示名指定'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => '肩書'),
		'belong' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => '所属'),
		'website' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => 'ウェブサイト'),
		'website2' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => 'ウェブサイト2'),
		'website3' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => 'ウェブサイト3'),
		'twitter' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => 'TwitterURL'),
		'facebook' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => 'facebookページURL'),
		'github' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => 'githubURL'),
		'google' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => 'Google+URL'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'comment' => '紹介文'),
		'show_blog_post' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'ブログ記事で表示する'),
		'show_post_num' => array('type' => 'integer', 'null' => true, 'default' => '5', 'length' => 2, 'unsigned' => false, 'comment' => '最新記事の表示数'),
		'show_image' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2, 'unsigned' => false, 'comment' => '公開側画像表示指定'),
		'file' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => 'プロフィール画像'),
		'gravatar_email' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => 'Gravatar用メールアドレス'),
		'gravatar_rating' => array('type' => 'string', 'null' => true, 'default' => 'g', 'length' => 2, 'comment' => 'Gravatarレーティング'),
		'gravatar_size' => array('type' => 'string', 'null' => true, 'default' => '80', 'length' => 20, 'comment' => 'Gravatar表示サイズ'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
	);

}
