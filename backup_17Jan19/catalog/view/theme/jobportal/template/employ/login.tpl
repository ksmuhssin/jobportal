<?php echo $header; ?>
<div class="top-breadcrumb">
	<div class="container">
		<h1><?php echo $heading_title; ?></h1>
		
	</div>
</div>
<div class="container">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
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
		<div class="row">
			<div class="col-sm-offset-2 col-md-8 col-xs-12">
              <div class="form">
			  <div class="border"></div>
			  <div class="border1"></div>
              <ul class="nav nav-tabs jobprofile">
                <li class="active"><a href="#tab-employee" data-toggle="tab"><?php echo $tab_employee; ?></a></li>
                <li><a href="#tab-company" data-toggle="tab"><?php echo $tab_company; ?></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab-employee">
              	  <div id="empldanger"></div>
              	<div class="candidateemail">
					<div class="form-group">
						<label class="control-label" for="input-email">
							<?php echo $label_email; ?></label>
						<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $label_email; ?>" id="input-email" class="form-control" />
					</div>
					<div class="form-group">
						<label class="control-label" for="input-password"><?php echo $label_password; ?></label>
						<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $label_password; ?>" id="input-password" class="form-control" />
					</div>
					<div class="form-group">
						<div class="col-sm-12 confirmation">
						<label>
							<input name="confirm" value="yes" type="checkbox"><?php echo $text_remember; ?>
						</label>
						<a href="<?php echo $forgotten; ?>" class="colorLink subHeadingText icon-wrap pull-right"><?php echo $text_forgotten; ?></a>
						</div>
					</div>
					<div class="buttons">
						<button type="button"  name="button" id="buttonempl" class="btn btn-primary btnus" /><?php echo $button_login; ?></button>
						</div>
					<p><?php echo $text_donot; ?> <a href="<?php echo $employragister; ?>"><?php echo $text_register; ?></a></p>
			     </div>
            </div>
            <div class="tab-pane" id="tab-company">
            	 <div id="companeydanger"></div>
              	<div class="companyclass">
				<div class="form-group">
					<label class="control-label" for="input-email"><?php echo $label_email; ?></label>
					<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $label_email; ?>" id="input-email" class="form-control" />
				</div>
				<div class="form-group">
					<label class="control-label" for="input-password"><?php echo $label_password; ?></label>
					<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $label_password; ?>" id="input-password" class="form-control" />
				</div>
				
				<div class="form-group">
					<div class="col-sm-12 confirmation">
				<label>
					<input name="confirm" value="yes" type="checkbox"><?php echo $text_remember; ?>
				</label>
					<a href="<?php echo $companyforget; ?>" class="colorLink subHeadingText icon-wrap pull-right"><?php echo $text_forgotten; ?></a>
					</div>
				</div>
				 
				<div class="buttons">
					<button type="button" name="button" id="combutton" class="btn btn-primary btnus" ><?php echo $button_login; ?></button>
			
					</div>
				<p><?php echo $text_donot; ?> <a href="<?php echo $compnaragister; ?>"><?php echo $text_registercom; ?></a></p>
                </div>
            </div>
            
        </div>
			</div>
        </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<script>
	$('#buttonempl').click(function(){
		$.ajax({
			url: 'index.php?route=employ/login/loginfunction',
			type: 'post',
			data: $('.candidateemail input'),
			dataType: 'json',
			beforeSend: function() {
			},
			success: function(json) {
			if (json['warning']) {
			$('#empldanger').html("<div class='alert alert-danger'><i class='fa fa-exclamation-circle'></i>"+json['warning']+"</div>");
		   }
		   if (json['loginlink']){
		   	      location=json['loginlink'];
		   }

		}
	});
	});

</script>

<script>
	$('#combutton').click(function(){
		$.ajax({
			url: 'index.php?route=employ/login/companyfunction',
			type: 'post',
			data: $('.companyclass input'),
			dataType: 'json',
			beforeSend: function() {
			},
			success: function(json) {
			if (json['comwarning']) {
			$('#companeydanger').html("<div class='alert alert-danger'><i class='fa fa-exclamation-circle'></i>"+json['comwarning']+"</div>");
		}
		if (json['complink']){
		   	      location=json['complink'];
		  }
						
			
		}
	});
	});

</script>
<?php echo $footer; ?>
