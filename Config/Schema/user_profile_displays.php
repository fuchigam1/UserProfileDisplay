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
		'status' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => '状態'),
		'show_name' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2, 'unsigned' => false, 'comment' => '公開側表示名'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '表示名指定', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '肩書', 'charset' => 'utf8'),
		'belong' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '所属', 'charset' => 'utf8'),
		'website' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ウェブサイト', 'charset' => 'utf8'),
		'website2' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ウェブサイト2', 'charset' => 'utf8'),
		'twitter' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'TwitterURL', 'charset' => 'utf8'),
		'facebook' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'facebookページURL', 'charset' => 'utf8'),
		'google' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Google+URL', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '紹介文', 'charset' => 'utf8'),
		'show_blog_post' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'ブログ記事で表示する'),
		'show_post_num' => array('type' => 'integer', 'null' => true, 'default' => '5', 'length' => 2, 'unsigned' => false, 'comment' => '最新記事の表示数'),
		'show_image' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2, 'unsigned' => false, 'comment' => '公開側画像表示指定'),
		'file' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'プロフィール画像', 'charset' => 'utf8'),
		'gravatar_email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Gravatar用メールアドレス', 'charset' => 'utf8'),
		'gravatar_rating' => array('type' => 'string', 'null' => true, 'default' => 'g', 'length' => 20, 'collate' => 'utf8_general_ci', 'comment' => 'Gravatarレーティング', 'charset' => 'utf8'),
		'gravatar_size' => array('type' => 'string', 'null' => true, 'default' => '80', 'length' => 20, 'collate' => 'utf8_general_ci', 'comment' => 'Gravatar表示サイズ', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
