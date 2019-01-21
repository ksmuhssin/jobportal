<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button>
       <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default">
          <i class="fa fa-reply">
          </i>
        </a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
<?php if ($success) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
	<?php } ?>

 
    <div class="panel panel-default">
        <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
        </div>
        <div class="panel-body">
			
	    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-information">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
			<thead>
				<tr>
				 <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
					<td class="text-left"><?php if ($sort == 'employname') { ?>
                    <a href="<?php echo $sort_employname; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_employname; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_employname; ?>"><?php echo $text_employname; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'jobname') { ?>
                    <a href="<?php echo $sort_jobname; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_jobname; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_jobname; ?>"><?php echo $text_jobname; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'jobtype') { ?>
                    <a href="<?php echo $sort_jobtype; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_jobtype; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_jobtype; ?>"><?php echo $text_jobtype; ?></a>
                    <?php } ?>
                  </td>
				<td class="text-left"><?php if ($sort == 'resume') { ?>
                    <a href="<?php echo $sort_resume; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_resume; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_resume; ?>"><?php echo $text_resume; ?></a>
                    <?php } ?>
                  </td>
					<td class="text-left"><?php if ($sort == 'date') { ?>
                    <a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_date; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date; ?>"><?php echo $text_date; ?></a>
                    <?php } ?>
                  </td>
										
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($applyjobinfos)) { ?>
				<?php foreach ($applyjobinfos as $applyjobinfo) { ?>
				<tr>
				 <td class="text-center">
			    <input type="checkbox" name="selected[]" value="<?php echo $applyjobinfo['ap_id']; ?>"  />
				</td>
				
					<td class="text-left"><?php echo $applyjobinfo['employname']; ?></td>
					<td class="text-left"><?php echo $applyjobinfo['jobname']; ?></td>
					<td class="text-left"><?php echo $applyjobinfo['type']; ?></td>
					<td class="text-left"><a href="<?php echo $applyjobinfo['cv']; ?>" target="_blank" download> download cv </a> </td>
					<td class="text-left"><?php echo $applyjobinfo['date_added']; ?></td>
				
				</tr>
				<?php } ?> 
				<?php } else { ?>
				<tr>
					<td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
			</div>
		</form>
			<div class="row">
				<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
				<div class="col-sm-6 text-right"><?php echo $results; ?></div>
			</div>
		</div>
	</div>
</div>

<?php echo $footer; ?>