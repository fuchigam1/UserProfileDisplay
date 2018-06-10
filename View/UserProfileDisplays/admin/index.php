<?php
/**
 * [View] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
$this->BcBaser->js(array(
	'admin/libs/jquery.baser_ajax_data_list',
	'admin/libs/baser_ajax_data_list_config',
	'admin/libs/jquery.baser_ajax_batch',
	'admin/libs/baser_ajax_batch_config',
));
?>
<script type="text/javascript">
$(document).ready(function(){
	$.baserAjaxDataList.init();
	$.baserAjaxBatch.init({ url: $("#AjaxBatchUrl").html()});
});
</script>

<div id="AjaxBatchUrl" style="display:none"><?php $this->BcBaser->url(array('controller' => 'user_profile_displays', 'action' => 'ajax_batch')) ?></div>
<div id="AlertMessage" class="message" style="display:none"></div>
<div id="DataList"><?php $this->BcBaser->element('user_profile_displays/index_list') ?></div>
