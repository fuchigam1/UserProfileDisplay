<?php
/**
 * [View] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
?>
<tr>
	<th>プロフィール表示管理メニュー</th>
	<td>
		<ul>
			<li><?php $this->BcBaser->link('一覧', array('admin' => true, 'plugin' => 'user_profile_display', 'controller' => 'user_profile_displays', 'action'=>'index')) ?></li>
			<li><?php $this->BcBaser->link('並び順割振り',
					array('admin' => true, 'plugin' => 'user_profile_display', 'controller' => 'user_profile_displays', 'action'=>'reposition'),
					array(),
					'並び順に値を割振ります。いいですか？',
					false) ?>
			</li>
		</ul>
	</td>
</tr>
