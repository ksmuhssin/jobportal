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
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
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
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="pull-right" style="margin-bottom: 15px;">
            <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button><a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
          </div>
        </div>
      </div>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-information">
		<div class="table-responsive">
		  <table class="table table-bordered table-hover">
			<thead>
               <tr>
				 <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
				 <td class="text-left"><?php echo $text_employname; ?></td>
				 <td class="text-left"><?php echo $text_jobname; ?></td>
				 <td class="text-left"><?php echo $text_jobtype; ?></td>
				 <td class="text-left"><?php echo $text_resume; ?></td>
				 <td class="text-left"><?php echo $text_date; ?></td>
				 <td class="text-left"><?php echo $text_viewprofile; ?></td>
 			  </tr>
		  </thead>
          <tbody>
           <?php if (!empty($applyjobinfos)) { ?>
			<?php foreach ($applyjobinfos as $applyjobinfo) { ?>
			<tr>
              <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $applyjobinfo['ap_id']; ?>"  /></td>
              <td class="text-left"><?php echo $applyjobinfo['employname']; ?></td>
			  <td class="text-left"><?php echo $applyjobinfo['jobname']; ?></td>
			  <td class="text-left"><?php echo $applyjobinfo['type']; ?></td>
              <td class="text-left"><a href="<?php echo $applyjobinfo['cv']; ?>" target="_blank" download>download cv </a></td>
              <td class="text-left"><?php echo $applyjobinfo['date_added']; ?></td>
              <td class="text-left"><a href="<?php echo $applyjobinfo['employview']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
			</tr>
			<?php } ?> 
			<?php } else { ?>
			<tr>
				<td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
				</tr>
			<?php } ?>
           </tbody>
		 </table>
        </div>
     </form>
	 <div class="row">
	    <div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
		<div class="col-sm-12 text-right"><?php echo $results; ?></div>
     </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>