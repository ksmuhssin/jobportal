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
					<select name="jobtype_id" disabled id="input-jobtype" class="form-control">
						<option selected="" value="0"><?php echo $text_select; ?></option>
						<option <?php if($jobtype_id==1) { echo "selected"; }  ?> value="1"><?php echo $text_part_time; ?></option>
						<option <?php if($jobtype_id==2) { echo "selected"; }  ?> value="2"><?php echo $text_full_time; ?></option>
					</select>
				</div>
			</div>
			<input type="hidden" name="resume_id" value="17" >
			<div class="form-group required">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_customer;?></label>		
				<div class="col-sm-12">
					<input type="text" name="customer" value="<?php echo $customer;?>" placeholder="<?php echo $entry_customer;?>" id="input-package-titl" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-12">
					<select name="status" disabled id="input-status" class="form-control">
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
				<label class="col-sm-12" for="input-resume"><?php echo $entry_image; ?></label>
				<div class="col-md-12 col-sm-12 col-xs-12 file text-center ">
				<div class="imagebox">
				<span id="thumb-image"><img src="<?php echo $thumb; ?>" alt="" title="" height="75" width="75" 	/></span>
				</div>
				
				
				
															
			</div>	
			
		</div>
		
		
        </fieldset>
      </form>
	  </div>
	  </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>


<?php echo $footer; ?>
