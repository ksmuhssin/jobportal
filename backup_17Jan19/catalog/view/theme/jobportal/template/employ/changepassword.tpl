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
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
		<div class="canditate-profile">
			<ul class="nav nav-tabs list-inline">
				<li class="">
					<a href="<?php echo $edashboard; ?>"><?php echo $tab_profile; ?></a>
				</li>
				<li class="">
					<a href="<?php echo $appliedjob; ?>"><?php echo $tab_apply; ?></a>
				</li>
				<li class="">
					<a href="<?php echo $editemploy; ?>"><?php echo $tab_postjob; ?></a>
				</li>
				<li class="active">
					<a href="<?php echo $changepassword; ?>"><?php echo $tab_change; ?></a>
				</li>
                <li class="">
					<a href="<?php echo $logout; ?>"><?php echo $tab_logout; ?></a>
				</li>
			</ul>
		</div>
	    <div class="col-sm-offset-3 col-md-6 col-sm-6  col-xs-12">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal password">
				<fieldset>
					<div class="form-group required">
						<label class="col-sm-12" for="input-password"><?php echo $label_old_password; ?></label>
						<div class="col-sm-12">
							<input type="password" name="oldpassword" value="<?php echo $password; ?>" placeholder="<?php echo $entry_old_password; ?>" id="input-oldpassword" class="form-control" />
						</div>
					</div>
					<input type="hidden" name="employ_id" value="<?php echo $employ_id;?>">
					<div class="form-group required">
						<label class="col-sm-12" for="input-password"><?php echo $label_new_password; ?></label>
						<div class="col-sm-12">
							<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_new_password; ?>" id="input-password" class="form-control" />
							<?php if ($error_password) { ?>
							<div class="text-danger"><?php echo $error_password; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-12" for="input-confirm"><?php echo $label_confirm; ?></label>
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
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<?php echo $footer; ?>
