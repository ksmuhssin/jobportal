<?php echo $header; ?>
<div class="bread">
	<div class="container">
		<h2><?php echo $heading_title; ?></h2>
		<div class="bread-box">
		
	</div>
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
            	<label class="col-sm-12" for="input-password"><?php echo $entry_oldpassword; ?></label>
           		<div class="col-sm-12">
              		<input type="password" name="oldpassword" value="<?php echo $oldpassword; ?>" placeholder="<?php echo $entry_oldpassword; ?>" id="input-password" class="form-control" />
            	</div>
          	</div>
		  	<input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
          	<div class="form-group required">
            	<label class="col-sm-12" for="input-password"><?php echo $entry_password; ?></label>
            	<div class="col-sm-12">
              		<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
              		<?php if ($error_password) { ?>
              		<div class="text-danger"><?php echo $error_password; ?></div>
              		<?php } ?>
            	</div>
          	</div>
          	<div class="form-group required">
            	<label class="col-sm-12" for="input-confirm"><?php echo $entry_confirm; ?></label>
            	<div class="col-sm-12">
              		<input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
              		<?php if ($error_confirm) { ?>
              		<div class="text-danger"><?php echo $error_confirm; ?></div>
              		<?php } ?>
            	</div>
          	</div>
        </fieldset>
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

<?php echo $footer; ?>
