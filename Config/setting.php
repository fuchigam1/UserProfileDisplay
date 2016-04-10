<?php
/**
 * [Config] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
/**
 * プロフィール表示用設定
 * 
 */
$config['UserProfileDisplay'] = array(
	// 公開側表示名
	'show_name' => array(
		0 => 'ニックネーム',
		1 => '表示名指定',
		2 => '名前（姓＋名）',
		3 => '名前（姓）',
		4 => '名前（名）',
		5 => '名前（名＋姓）',
		6 => 'アカウント名',
	),
	// 表示画像種別
	'show_image' => array(
		0 => '表示なし',
		1 => '画像指定',
		2 => 'Gravatar',
		
	),
	// Gravatarのレーティング
	'gravatar_rating' => array(
		'g'	=> 'G：あらゆる人に適切',
		'pg' => 'PG：不快感を与える恐れ(13歳以上向き)',
		'r' => 'R：18歳以上の成人向き',
		'x' => 'X：最高レベルの制限',
	),
	// デフォルトアバター画像種類
//	'gravatar_kind' => array(
//		'mm' => 'Gravatar設定画像',
//		'404' => 'ミステリーパーソン',
//		'identicon' => 'Identicon',
//		'monsterid' => 'MonsterID',
//		'wavatar' => 'Wavatar',
//	),
);
