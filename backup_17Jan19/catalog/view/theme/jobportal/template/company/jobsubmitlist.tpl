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
        <div class="pull-right" style="margin-bottom: 15px;"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button>
        </div>
        </div>
      </div>
	  <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-information">
		<div class="table-responsive">
		  <table class="table table-bordered table-hover">
			<thead>
              <tr>
				<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
				<td class="text-left"><?php echo $column_image; ?></td>
				<td class="text-left"><?php echo $column_job; ?></td>
				<td class="text-left"><?php echo $column_title; ?></td>
				<td class="text-left"><?php echo $column_experience; ?></td>
				<td class="text-left"><?php echo $column_applyjoblist; ?></td>
                <td class="text-left"><?php echo $column_action; ?></td>
			  </tr>
			</thead>
			<tbody>
              <?php if ($job_infos) { ?>
				<?php foreach ($job_infos as $result) { ?>
				<tr>
				  <td class="text-center">
			       <input type="checkbox" name="selected[]" value="<?php echo $result['job_id']; ?>"  />
				  </td>
				  <td class="text-center"><?php if ($result['banner']) { ?>
				     <img src="<?php echo $result['banner']; ?>" alt="<?php echo $result['banner']; ?>" class="img-thumbnail" />
				  <?php } else { ?>
					<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
				  <?php } ?>
                  </td>
                  <td class="text-left"><?php echo $result['type']; ?></td>
				  <td class="text-left"><?php echo $result['title']; ?></td>
				  <td class="text-left"><?php echo $result['experience']; ?></td>
				  <td class="text-left"><a href="<?php echo $result['applylist']; ?>">Apply List</a> (Total Cv: <?php echo $result['jobtotal']; ?> ) </td>
                  <td class="text-right"><a href="<?php echo $result['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
				  <a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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