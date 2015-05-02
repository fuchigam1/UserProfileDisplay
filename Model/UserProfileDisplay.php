<?php
/**
 * [Model] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class UserProfileDisplay extends BcPluginAppModel {
/**
 * ModelName
 * 
 * @var string
 */
	public $name = 'UserProfileDisplay';
	
/**
 * PluginName
 * 
 * @var string
 */
	public $plugin = 'UserProfileDisplay';
	
/**
 * ビヘイビア
 * 
 * @var array
 */
	public $actsAs = array(
		'BcCache',
		'BcUpload' => array(
			'saveDir' => 'user_profile_display',
			'fields' => array(
				'file' => array(
					'type' => 'image',
					'namefield' => 'id',
					'nameformat' => '%04d',
					//'imageresize' => array('prefix' => 'resize', 'width' => '300', 'height' => '300'),
					'imagecopy' => array(
						'small'		=> array('suffix' => '_small', 'width' => '100', 'height' => '100'),
						'thumb'		=> array('suffix' => '_thumb', 'width' => '150', 'height' => '150'),
						'medium'	=> array('suffix' => '_medium', 'width' => '200', 'height' => '200'),
						'large'		=> array('suffix' => '_large', 'width' => '300', 'height' => '300'),
					),
				),
			),
		),
	);
	
/**
 * belongsTo
 * 
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className'	=> 'User',
			'foreignKey' => 'user_id'
		),
	);
	
}
