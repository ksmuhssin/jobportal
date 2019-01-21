<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
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
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	<!--<div id="msgs"></div>-->
      <h1><?php echo $heading_title; ?></h1>
		<form method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-package-title"><?php echo $entry_email;?></label>		
				<div class="col-sm-10">
					<input type="email" name="email" value="" placeholder="<?php echo $entry_email; ?>" id="email" class="form-control" />
					<div id="val-e"></div>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-package-title">
				<?php echo $entry_description;?>
				</label>
				<div class="col-sm-10 summernote">
					<textarea name="message" placeholder="<?php echo $entry_description; ?>" id="description" class="form-control"></textarea>
					<div id="val-d"></div>
				</div>
			</div>
			<div class="buttons">
				<div class="pull-right">
				<button class="btn btn-primary"  value="" type="button" id="enquerybutton"><?php echo $button_save; ?></button>
			</div>
			</div>
		</form>
	
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 

<script type="text/javascript">
$(document).ready(function() {
  $('.summernote').summernote();
});
</script> 	

<script>
	$('#enquerybutton').click(function(){
		var e = $("#email").val();
		var d = $("#description").val();
		if(e.length<5){
			$("#val-e").html("E-Mail Address does not appear to be valid!");
			$("#val-e").css("color", "red");
		}
		if(d.length<5){
		$("#val-d").html("message must be of 10 characters");
			$("#val-d").css("color", "red");
		}else{
	     $.ajax({
				url: 'index.php?route=job/message/emailmessagesend',
				type: 'post',
				data: $('input[name=\'email\'],textarea[name=\'message\']'),
				dataType: 'json',
				beforeSend: function() {
				},
				success: function(json) {
					if (json['success']) {
						//$('#msgs').html("<div class='alert alert-success'>"+json['success']+"</div>");
						$("#val-e").html("");
						$("#val-d").html("");
						$("#email").val('');
						$("#description").val('');
				
					}
				}
			});
	}
		
	});
	</script> 
<?php echo $footer; ?>