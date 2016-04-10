<?php
/**
 * [View] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
?>
<?php $this->BcBaser->element('pagination') ?>

<table cellpadding="0" cellspacing="0" class="list-table sort-table" id="ListTable">
	<thead>
		<tr>
			<th class="list-tool">
				&nbsp;
			</th>
			<th><?php echo $this->Paginator->sort('position', array(
					'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 並び順',
					'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 並び順'),
					array('escape' => false, 'class' => 'btn-direction')) ?>
			</th>
			<th>
				アカウント名
			</th>
			<th>
				公開側表示名
				<br />
				指定してある表示名
			</th>
			<th><?php echo $this->Paginator->sort('created', array(
					'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 登録日',
					'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 登録日'),
					array('escape' => false, 'class' => 'btn-direction')) ?>
				<br />
				<?php echo $this->Paginator->sort('modified', array(
					'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 更新日',
					'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 更新日'),
					array('escape' => false, 'class' => 'btn-direction')) ?>
			</th>
		</tr>
	</thead>
	<tbody>
<?php if(!empty($datas)): ?>
	<?php foreach ($datas as $key => $data): ?>
		<?php $this->BcBaser->element('user_profile_displays/index_row', array('data' => $data, 'count' => ($key + 1))) ?>
	<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan="5"><p class="no-data">データがありません。</p></td>
	</tr>
<?php endif; ?>
	</tbody>
</table>

<!-- list-num -->
<?php $this->BcBaser->element('list_num') ?>
