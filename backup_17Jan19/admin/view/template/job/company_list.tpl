<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
        </div>
        <div class="panel-body">
			<div class="well">
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label class="control-label" for="input-name"><?php echo $filterlb_fullname; ?></label>
							<input type="text" name="filter_full_name" value="<?php echo $filter_full_name ?>" placeholder="<?php echo $filterlb_fullname; ?>" id="input-full_name" class="form-control" />
						</div>
					</div>
								
					<div class="col-sm-5">
						<div class="form-group">
							<label class="control-label" for="input-email"><?php echo $filterlb_email; ?></label>
							<input type="text" name="filter_email" value="<?php echo $filter_email ?>" placeholder="<?php echo $filterlb_email; ?>" id="input-email" class="form-control" />
						</div>
					</div>
					

					<div class="col-sm-2 text-center">
						<button type="button" id="button-filter" class="btn btn-primary"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
					</div>
				</div>
			</div>	
	    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-information">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
							<td class="text-left"><?php if ($sort=='full_name') { ?>
								<a href="<?php echo $sort_full_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_full_name; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_full_name; ?>"><?php echo $column_full_name; ?></a>
								<?php } ?>
							</td>
								
							<td class="text-left"><?php if ($sort == 'company_name') { ?>
								<a href="<?php echo $sort_company_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_company_name; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_company_name; ?>"><?php echo $column_company_name; ?></a>
								<?php } ?>
							</td>
							
							<td class="text-left"><?php if ($sort == 'country') { ?>
								<a href="<?php echo $sort_country; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_country; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_country; ?>"><?php echo $column_country; ?></a>
								<?php } ?>
							</td>
							
							<td class="text-left"><?php if ($sort == 'zone') { ?>
								<a href="<?php echo $sort_zone; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_zone; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_zone; ?>"><?php echo $column_zone; ?></a>
								<?php } ?>
							</td>
							
							<td class="text-left"><?php if ($sort == 'email') { ?>
								<a href="<?php echo $sort_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_email; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_email; ?>"><?php echo $column_email; ?></a>
								<?php } ?>
							</td>

							
							<td class="text-left"><?php echo $column_approve; ?></td>
							<td class="text-left"><?php echo $column_action; ?></td>
						</tr>
					</thead>
						<?php if ($company) { ?>
						<?php foreach ($company as $result) { ?>
						<tr>
							<td class="text-center"><?php if (in_array($result['company_id'], $selected)) { ?>
								<input type="checkbox" name="selected[]" value="<?php echo $result['company_id']; ?>" checked="checked" />
								<?php } else { ?>
								<input type="checkbox" name="selected[]" value="<?php echo $result['company_id']; ?>" />
								<?php } ?>
							</td>
							<td class="text-left"><?php echo $result['full_name']; ?></td>
							<td class="text-left"><?php echo $result['company_name']; ?></td>
							<td class="text-left"><?php echo $result['country']; ?></td>
							<td class="text-left"><?php echo $result['zone']; ?></td>
							<td class="text-left"><?php echo $result['email']; ?></td>
							
							<td class="text-right"><?php if ($result['approve']) { ?>
								<a href="<?php echo $result['approve']; ?>" data-toggle="tooltip" title="<?php echo $button_approve; ?>" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></a>
								<?php } else { ?>
								<button type="button" class="btn btn-success" disabled><i class="fa fa-thumbs-o-up"></i></button>
								<?php } ?>

								<?php if ($result['disapproved']) { ?>
								<a href="<?php echo $result['disapproved']; ?>" data-toggle="tooltip" title="<?php echo $button_desapprove; ?>" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i></a>
								<?php } else { ?>
								<button type="button" class="btn btn-danger" disabled><i class="fa fa-thumbs-o-down"></i></button>
								<?php } ?>
									
							</td>
							<td class="text-left"><a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
						
						</tr>
						<?php } ?> 
						<?php } else { ?>
						<tr>
							<td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
						</tr>
					<?php } ?>
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
<script type="text/javascript">
//$('#button-filter').on('click', function() {
$(document).on('click','#button-filter',function() { 
	var url = 'index.php?route=job/company&token=<?php echo $token; ?>';

	var filter_full_name = $('input[name=\'filter_full_name\']').val();

	if (filter_full_name) {
		url += '&filter_full_name=' + encodeURIComponent(filter_full_name);
	}


	var filter_email = $('input[name=\'filter_email\']').val();

	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}

	location = url;
});
</script>

<script type="text/javascript"><!--
$(document).bind('keypress', function(e) {
      if(e.keyCode==13){
           $('#button-filter').trigger('click');
       }
  });
</script>

<script type="text/javascript">
$('input[name=\'filter_country\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=localisation/country/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					country_id: 0,
					name:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['country_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_country\']').val(item['label']);
		$('input[name=\'country_id\']').val(item['value']);
	}
});
</script>
<script type="text/javascript">
$('input[name=\'filter_zone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=localisation/zone/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					zone_id: 0,
					name:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['zone_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_zone\']').val(item['label']);
		$('input[name=\'zone_id\']').val(item['value']);
	}
});
</script>

<?php echo $footer; ?>