<?php
/**
 * [View] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
$classies = array();
?>
<tr>
	<td class="row-tools">
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')),
			array('plugin' => null, 'controller' => 'users', 'action' => 'edit',
					$data['User']['id']), array('title' => '編集')) ?>

	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_delete.png', array('width' => 24, 'height' => 24, 'alt' => '削除', 'class' => 'btn')),
			array('action' => 'ajax_delete', $data['UserProfileDisplay']['id']), array('title' => '削除', 'class' => 'btn-delete')) ?>

		<?php if ($count != 1 || !isset($datas)): ?>
			<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_up.png', array('width' => 24, 'height' => 24, 'alt' => '上へ移動', 'class' => 'btn')),
					array('controller' => 'user_profile_displays', 'action' => 'move_up', $data['UserProfileDisplay']['id']), array('class' => 'btn-up', 'title' => '上へ移動')) ?>
		<?php else: ?>
			<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_up.png', array('width' => 24, 'height' => 24, 'alt' => '上へ移動', 'class' => 'btn')),
					array('controller' => 'user_profile_displays', 'action' => 'move_up', $data['UserProfileDisplay']['id']), array('class' => 'btn-up', 'title' => '上へ移動', 'style' => 'display:none')) ?>
		<?php endif ?>
		
		<?php if (!isset($datas) || count($datas) != $count): ?>
			<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_down.png', array('width' => 24, 'height' => 24, 'alt' => '下へ移動', 'class' => 'btn')),
					array('controller' => 'user_profile_displays', 'action' => 'move_down', $data['UserProfileDisplay']['id']), array('class' => 'btn-down', 'title' => '下へ移動')) ?>
		<?php else: ?>
			<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_down.png', array('width' => 24, 'height' => 24, 'alt' => '下へ移動', 'class' => 'btn')),
					array('controller' => 'user_profile_displays', 'action' => 'move_down', $data['UserProfileDisplay']['id']), array('class' => 'btn-down', 'title' => '下へ移動', 'style' => 'display:none')) ?>
		<?php endif ?>
	</td>
	<td>
		<?php echo $data['UserProfileDisplay']['position']; ?>
	</td>
	<td>
		<?php echo $this->BcBaser->link($data['User']['name'],
				array('plugin' => null, 'controller' => 'users', 'action' => 'edit',
						$data['User']['id']), array('title' => '編集')) ?>
	</td>
	<td>
		<?php echo $this->BcText->arrayValue($data['UserProfileDisplay']['show_name'], Configure::read('UserProfileDisplay.show_name')) ?>
		<br />
		<?php echo $data['UserProfileDisplay']['name'] ?>
	</td>
	<td style="white-space: nowrap">
		<?php echo $this->BcTime->format('Y-m-d', $data['UserProfileDisplay']['created']) ?>
		<br />
		<?php echo $this->BcTime->format('Y-m-d', $data['UserProfileDisplay']['modified']) ?>
	</td>
</tr>
