<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul><?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
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
    <div id="content" >
		<div class="pull-right">
		<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
          <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
       <h1><?php echo $heading_title; ?></h1>
			<div class="well">
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-name"><?php echo $column_titlename; ?></label>
							<input type="text" name="filter_title" value="" placeholder="<?php echo $column_titlename; ?>" id="input-name" class="form-control" />
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-package-title"><?php echo $column_country;?> </label>
								<input type="text" name="filter_country" value="" placeholder="<?php echo $column_country; ?>" id="input-name" class="form-control" />
								<input type="hidden" name="country_id" value="">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-package-title"><?php echo $column_zone; ?></label>
								<input type="text" name="filter_zone" value="" placeholder="<?php echo $column_zone; ?>" id="input-name" class="form-control" />
								<input type="hidden" name="zone_id" value="">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-package-title"><?php echo $column_company; ?></label>
								<input type="text" name="filter_company" value="" placeholder="<?php echo $column_company; ?>" id="input-name" class="form-control" />
								<input type="hidden" name="company_id" value="">
						</div>
					</div>
				</div>
				<div class="row">
					<!--<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-name"><?php echo $column_category; ?></label>
								<input type="text" name="filter_category" value="" placeholder="<?php echo $column_category; ?>" id="input-name" class="form-control" />
						</div>
					</div>--->
					<!---<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-name"><?php echo $column_jobtype; ?></label>
								<select name="filter_jobtype" class="form-control" >
									<option selected="" value="0"><?php echo $text_select; ?></option>
									<option value="1"><?php echo $text_part_time; ?></option>
									<option value="2"><?php echo $text_full_time; ?></option>
								</select>
						</div>
					</div>-->
					<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-name"><?php echo $column_meta_title; ?></label>
								<input type="text" name="filter_meta_title" value="" placeholder="<?php echo $column_meta_title; ?>" id="input-name" class="form-control" />
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-name"><?php echo $column_city; ?></label>
								<input type="text" name="filter_city" value="" placeholder="<?php echo $column_city; ?>" id="input-name" class="form-control" />
						</div>
					</div>
					<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
				</div>
			</div>
		
			 <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-information">
     			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
							
							<td class="text-left"><?php if ($sort == 'title') { ?>
								<a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_titlename; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_title; ?>"><?php echo $column_titlename; ?></a>
								<?php } ?>
							</td>
							<td class="text-left"><?php if ($sort == 'country') { ?>
								<a href="<?php echo $sort_country; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_country; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_country	; ?>"><?php echo $column_country; ?></a>
								<?php } ?>
							</td>
							<td class="text-left"><?php if ($sort == 'zone') { ?>
								<a href="<?php echo $sort_zone; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_zone; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_zone	; ?>"><?php echo $column_zone; ?></a>
								<?php } ?>
							</td>
							<td class="text-left"><?php if ($sort == 'company') { ?>
								<a href="<?php echo $sort_company; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_companys; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_company;?>"><?php echo $column_companys; ?></a>
								<?php } ?>
							</td>
							<td class="text-left"><?php if ($sort == 'meta_title') { ?>
								<a href="<?php echo $sort_meta_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_meta_title; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_meta_title; ?>"><?php echo $column_meta_title; ?></a>
								<?php } ?>
							</td>
							<td class="text-left"><?php if ($sort == 'city') { ?>
								<a href="<?php echo $sort_city; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_city; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_city	; ?>"><?php echo $column_city; ?></a>
								<?php } ?>
							</td>
							<td class="text-left"><?php if ($sort == 'jobtype_id') { ?>
								<a href="<?php echo $sort_jobtype_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_jobtype_id; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_jobtype_id	; ?>"><?php echo $column_jobtype_id; ?></a>
								<?php } ?>
							</td>
							<td class="text-left"><?php echo $column_action; ?></td>
						</tr>
					</thead>
					<?php if ($postjobs) { ?>
						<?php foreach ($postjobs as $result) { ?>
						<tr>
							<td class="text-center"><?php if (in_array($result['job_id'], $selected)) { ?>
								<input type="checkbox" name="selected[]" value="<?php echo $result['job_id']; ?>" checked="checked" />
								<?php } else { ?>
								<input type="checkbox" name="selected[]" value="<?php echo $result['job_id']; ?>" />
								<?php } ?>
							</td>
							<td class="text-left"><?php echo $result['title']; ?></td>
							<td class="text-left"><?php echo $result['country']; ?></td>
							<td class="text-left"><?php echo $result['zone']; ?></td>
							<td class="text-left"><?php echo $result['company']; ?></td>
							<td class="text-left"><?php echo $result['meta_title']; ?></td>
							<td class="text-left"><?php echo $result['city']; ?></td>
							<td class="text-left"><?php echo $result['type']; ?></td>
							<td class="text-left"><a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
						</tr>
						<?php } ?> 
							<?php } else { ?>
						<tr>
							<td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
						</tr>
						<?php } ?>
            </table>
          </div>
    </form>
			 <div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
          <div class="col-sm-12 text-right"><?php echo $results; ?></div>
				</div>
    </div>
</div>


<script type="text/javascript">
$('#button-filter').on('click', function() {

	var url = 'index.php?route=job/postjob/view';
	var filter_title = $('input[name=\'filter_title\']').val();
	if (filter_title) {
		url += '&filter_title=' + encodeURIComponent(filter_title);
	}
	var filter_country = $('input[name=\'country_id\']').val();

	if (filter_country) {
		url += '&filter_country=' + encodeURIComponent(filter_country);
	}
	var filter_zone = $('input[name=\'zone_id\']').val();

	if (filter_zone) {
		url += '&filter_zone=' + encodeURIComponent(filter_zone);
	}
	var filter_company = $('input[name=\'company_id\']').val();

	if (filter_company) {
		url += '&filter_company=' + encodeURIComponent(filter_company);
	}
	var filter_category = $('input[name=\'category_id\']').val();

	if (filter_category) {
		url += '&filter_category=' + encodeURIComponent(filter_category);
	}
	
	/*var filter_jobtype = $('select[name=\'jobtype_id\']').val();

	if (filter_jobtype) {
		url += '&filter_jobtype=' + encodeURIComponent(filter_jobtype);
	}*/
	
	
	
	
	var filter_city = $('input[name=\'filter_city\']').val();

	if (filter_city) {
		url += '&filter_city=' + encodeURIComponent(filter_city);
	}
	
	var filter_meta_title = $('input[name=\'filter_meta_title\']').val();

	if (filter_meta_title) {
		url += '&filter_meta_title=' + encodeURIComponent(filter_meta_title);
	}
	location = url;
});
</script>

	<script type="text/javascript">
$('input[name=\'filter_country\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=localisation/country/autocomplete&filter_name=' +  encodeURIComponent(request),
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
			url: 'index.php?route=localisation/zone/autocomplete&filter_name=' +encodeURIComponent(request),
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
<script type="text/javascript">
$('input[name=\'filter_company\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=job/postjob/autocomplete&filter_full_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					company_id: 0,
					full_name:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['full_name'],
						value: item['company_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_company\']').val(item['label']);
		$('input[name=\'company_id\']').val(item['value']);
	}
});
</script>
<script type="text/javascript">
$('input[name=\'filter_category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=job/category/autocomplete&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					category_id: 0,
					name:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_category\']').val(item['label']);
		$('input[name=\'category_id\']').val(item['value']);
	}
});
</script>
<script type="text/javascript">
$('input[name=\'filter_jobtype\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=job/jobtype/autocomplete&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					jobtype_id: 0,
					jobtype:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['jobtype'],
						value: item['jobtype_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_jobtype\']').val(item['label']);
		$('input[name=\'jobtype_id\']').val(item['value']);
	}
});
</script>
<?php echo $footer; ?>