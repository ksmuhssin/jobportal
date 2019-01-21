<?php echo $header; ?>
<div class="top-breadcrumb">
	<div class="container">
		<h1><?php echo $heading_title; ?></h1>
		<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>
<div class="container">
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> login-form"><?php echo $content_top; ?>
	  <div class="col-sm-offset-3 col-md-6 col-xs-12">
	  <div class="form">
		<div class="border"></div>
		<div class="border1"></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          <legend><?php echo $text_your_details; ?></legend>
          
			<div class="form-group required">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_jobtype;?></label>		
				<div class="col-sm-12">
					<select name="jobtype_id" id="input-jobtype" class="form-control">
						<option selected="" value="0"><?php echo $text_select; ?></option>
						<option value="1"><?php echo $text_part_time; ?></option>
						<option value="2"><?php echo $text_full_time; ?></option>
					</select>
					<?php if ($error_jobtype_id) { ?>
					<div class="text-danger"><?php echo $error_jobtype_id; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_customer;?></label>		
				<div class="col-sm-12">
					<input type="text" name="customer" value="<?php echo $customer;?>" placeholder="<?php echo $entry_customer;?>" id="input-package-titl" class="form-control" >
					<?php if ($error_customer) { ?>
					<div class="text-danger"><?php echo $error_customer; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-12">
					<select name="status" id="input-status" class="form-control">
						<?php if ($status) { ?>
						<option value="1" selected="selected"><?php echo $text_enable; ?></option>
						<option value="0"><?php echo $text_disable; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_enable; ?></option>
						<option value="0" selected="selected"><?php echo $text_disable; ?></option>
						<?php } ?>
					</select>	
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12" for="input-image"><?php echo $entry_image; ?></label>
				<div class="col-md-12 col-sm-12 col-xs-12 file text-center ">
					<div class="imagebox">
					<span id="thumb-image"><img src="<?php echo $thumb; ?>" alt="" title="" height="75" width="75" 	/></span>
					</div>
					 <button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i><?php echo $button_upload; ?></button>
					<input type="hidden" name="resume" value="<?php echo $resume; ?>" id="input-image" />
					<?php if ($error_resume) { ?>
					<div class="text-danger"><?php echo $error_resume; ?></div>
					<?php } ?>									
				</div>	
			</div>
        </fieldset>
        <?php echo $captcha; ?>
		<div class="buttons">
            &nbsp;
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary btnus"/>
        </div>
      </form>
	  </div>
	  </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<script type="text/javascript">
			
$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=resume/resume/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
						$("#thumb-image").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100"/>');
						$("#input-image").val(json['location1']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

</script>
<?php echo $footer; ?>
