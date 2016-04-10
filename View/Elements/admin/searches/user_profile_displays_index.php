<?php
/**
 * [View] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
?>
<?php echo $this->BcForm->create('UserProfileDisplay', array('url' => array('action'=>'index'))) ?>
<p>
	<span>
		<?php echo $this->BcForm->label('UserProfileDisplay.show_name', '表示名') ?>
		&nbsp;<?php echo $this->BcForm->input('UserProfileDisplay.show_name', array('type' => 'select', 'options' => Configure::read('UserProfileDisplay.show_name'), 'empty' => '指定なし')) ?>
	</span>
	<span>
		<?php echo $this->BcForm->label('UserProfileDisplay.name', '指定してある表示名') ?>
		&nbsp;<?php echo $this->BcForm->input('UserProfileDisplay.name', array('type' => 'text', 'size' => '20')) ?>
	</span>
</p>
<div class="button">
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn')), "javascript:void(0)", array('id' => 'BtnSearchSubmit')) ?> 
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/btn_clear.png', array('alt' => 'クリア', 'class' => 'btn')), "javascript:void(0)", array('id' => 'BtnSearchClear')) ?> 
</div>
<?php echo $this->BcForm->end() ?>
