<?php
/**
 * [ADMIN] UserProfileDisplay
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
?>
</table>

<script type="text/javascript">
$(function () {
	$fieldType = $("#UserProfileDisplayShowName").val();
	userProfileDisplayNameChangeHandler($fieldType);
	// 公開側表示名を 表示名指定 に切り替えると入力欄を表示する
	$("#UserProfileDisplayShowName").on('change', function(){
		userProfileDisplayNameChangeHandler($("#UserProfileDisplayShowName").val());
	});
	function userProfileDisplayNameChangeHandler(value){
		switch (value){
			case '1':
				$('#PreviewUserProfileDisplay').removeClass('display-none');
				break;
				
			default:
				$('#PreviewUserProfileDisplay').addClass('display-none');
				break;
		}
	}
	
	$imageType = $("#UserProfileDisplayShowImage").val();
	userProfileDisplayShowImageChangeHandler($imageType);
	// 公開側表示画像を Gravatar に切り替えるとGravatar登録中メールアドレス入力欄を表示する
	$("#UserProfileDisplayShowImage").on('change', function(){
		userProfileDisplayShowImageChangeHandler($("#UserProfileDisplayShowImage").val());
	});
	function userProfileDisplayShowImageChangeHandler(value){
		switch (value){
			case '1':
				$('#PreviewUserProfileDisplayGravatar').addClass('display-none');
				$('.profile-image').show('slow');
				$('.profile-image-gravatar').hide('fast');
				break;
				
			case '2':
				$('#PreviewUserProfileDisplayGravatar').removeClass('display-none');
				$('.profile-image').hide('slow');
				$('.profile-image-gravatar').show('fast');
				break;
			
			default:
				$('#PreviewUserProfileDisplayGravatar').addClass('display-none');
				$('.profile-image').hide('fast');
				$('.profile-image-gravatar').hide('fast');
				break;
		}
	}
});
</script>

<?php echo $this->BcForm->input('UserProfileDisplay.id', array('type' => 'hidden')) ?>
<table cellpadding="0" cellspacing="0" class="form-table" id="UserProfileDisplayTable">
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.status', 'プロフィール公開状態') ?>&nbsp;<span class="required">*</span>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('UserProfileDisplay.status', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('公開'))) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.status') ?>
		</td>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.show_post_num', 'ブログ記事表示') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('UserProfileDisplay.show_blog_post', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('表示'))) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.show_blog_post') ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->BcForm->input('UserProfileDisplay.show_post_num', array('type' => 'text', 'size' => 4)) ?>件
			<?php echo $this->BcForm->error('UserProfileDisplay.show_post_num') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.show_name', '公開側表示名') ?>&nbsp;<span class="required">*</span>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.show_name', array('type' => 'select', 'options' => Configure::read('UserProfileDisplay.show_name'))) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.show_name') ?>
			<span id="PreviewUserProfileDisplay" class="display-none">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $this->BcForm->label('UserProfileDisplay.name', '指定') ?>
				<?php echo $this->BcForm->input('UserProfileDisplay.name', array('type' => 'text', 'size' => 40, 'maxlength' => 255, 'counter' => true, 'style' => 'width: 60%')) ?>
				<?php echo $this->BcForm->error('UserProfileDisplay.name') ?>
			</span>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.show_name', '公開側表示画像') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.show_image', array('type' => 'select', 'options' => Configure::read('UserProfileDisplay.show_image'))) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.show_image') ?>
			<span id="PreviewUserProfileDisplayGravatar" class="display-none">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $this->BcForm->label('UserProfileDisplay.gravatar_email', 'メールアドレス設定') ?>
				<?php echo $this->BcForm->input('UserProfileDisplay.gravatar_email', array('type' => 'text', 'size' => 40, 'maxlength' => 255, 'style' => 'width: 61%')) ?>
				<?php echo $this->BcForm->error('UserProfileDisplay.gravatar_email') ?>
				<br /><small><a href="https://ja.gravatar.com/" target="_blank">Gravatar</a>に登録しているメールアドレスを入力してください。設定すると画像が表示されます。</small>
			</span>
		</td>
	</tr>
	<tr class="profile-image-gravatar">
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.gravatar_size', 'Gravatar') ?>
			<br />
			<small><?php echo $this->BcForm->label('UserProfileDisplay.gravatar_rating', 'レーティング') ?></small>
		</th>
		<td class="col-input" colspan="3">
			<div>
			<?php echo $this->BcForm->input('UserProfileDisplay.gravatar_size', array('type' => 'text', 'size' => 5, 'maxlength' => '5')) ?>
				pixel<small>（2048以下でご指定ください。）</small>
			<?php echo $this->BcForm->error('UserProfileDisplay.gravatar_size') ?>
			</div>
			<?php echo $this->UserProfileDisplay->get_gravatar($this->BcForm->value('UserProfileDisplay.gravatar_email'),
					array(
						'size' => $this->BcForm->value('UserProfileDisplay.gravatar_size'),
						'rating' => $this->BcForm->value('UserProfileDisplay.gravatar_rating'),
						'img' => true
					)
			) ?>
			<br />
			<?php echo $this->BcForm->input('UserProfileDisplay.gravatar_rating', array(
				'type' => 'radio', 'options' => Configure::read('UserProfileDisplay.gravatar_rating')
			)) ?>
		</td>
	</tr>
	<tr class="profile-image">
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.file', 'プロフィール画像') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->file('UserProfileDisplay.file', array('imgsize' => 'thumb')) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.file') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.belong', '所属') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('UserProfileDisplay.belong', array(
				'type' => 'text', 'size' => 26, 'maxlength' => 255,
				'placeholder' => '所属団体名（会社名など）', 'style' => 'width: 95%')) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.title') ?>
			<br /><small>未入力時は表示されません。</small>
		</td>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.title', '肩書き') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.title', array('type' => 'text', 'size' => 26, 'maxlength' => 255,
				'placeholder' => '役職など', 'style' => 'width: 95%')) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.title') ?>
			<br /><small>未入力時は表示されません。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.website', 'URL') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.website', array(
				'type' => 'textarea', 'rows' => 2,
				'placeholder' => 'ご自身でお持ちのウェブサイトURLを入力してください。', 'style' => 'width: 85%'
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.website') ?>
			<br /><small>未入力時は表示されません。1行目はリンク用文字列、2行目にURLを入力してください。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.website2', 'URL2') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.website2', array(
				'type' => 'textarea', 'rows' => 2,
				'style' => 'width: 85%'
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.website2') ?>
			<br /><small>未入力時は表示されません。1行目はリンク用文字列、2行目にURLを入力してください。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.website3', 'URL3') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.website3', array(
				'type' => 'textarea', 'rows' => 2,
				'style' => 'width: 85%'
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.website3') ?>
			<br /><small>未入力時は表示されません。1行目はリンク用文字列、2行目にURLを入力してください。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.twitter', 'URL: Twitter') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.twitter', array(
				'type' => 'textarea', 'rows' => 2,
				'placeholder' => 'https://twitter.com/YOUR_ACCOUNT', 'style' => 'width: 85%'
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.twitter') ?>
			<br /><small>未入力時は表示されません。1行目はリンク用文字列、2行目にURLを入力してください。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.facebook', 'URL: facebook') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.facebook', array(
				'type' => 'textarea', 'rows' => 2,
				'placeholder' => 'https://www.facebook.com/YOUR_FACEBOOK_PAGE', 'style' => 'width: 85%'
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.facebook') ?>
			<br /><small>未入力時は表示されません。1行目はリンク用文字列、2行目にURLを入力してください。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.github', 'URL: github') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.github', array(
				'type' => 'textarea', 'rows' => 2,
				'placeholder' => 'https://github.com/YOUR_GITHUB_ACCOUNT', 'style' => 'width: 85%'
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.github') ?>
			<br /><small>未入力時は表示されません。1行目はリンク用文字列、2行目にURLを入力してください。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.google', 'URL: Google＋') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->input('UserProfileDisplay.google', array(
				'type' => 'textarea', 'rows' => 2,
				'placeholder' => 'https://plus.google.com/YOUR_URL', 'style' => 'width: 85%'
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.google') ?>
			<br /><small>未入力時は表示されません。1行目はリンク用文字列、2行目にURLを入力してください。</small>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('UserProfileDisplay.description', '紹介文') ?>
		</th>
		<td class="col-input" colspan="3">
			<?php echo $this->BcForm->ckeditor('UserProfileDisplay.description', array(
				'editorWidth' => 'auto',
				'editorHeight' => '150px',
				'editorToolType' => 'simple',
				'editorEnterBr' => 'BcCkeditor',
				//'editorEnterBr' => @$siteConfig['editor_enter_br'],
			)) ?>
			<?php echo $this->BcForm->error('UserProfileDisplay.description') ?>
		</td>
	</tr>
