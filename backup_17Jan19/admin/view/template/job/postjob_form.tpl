<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
          <i class="fa fa-save">
          </i>
        </button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default">
          <i class="fa fa-reply">
          </i>
        </a>
      </div>
      <h1>
        <?php echo $heading_title; ?>
      </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li>
          <a href="<?php echo $breadcrumb['href']; ?>">
            <?php echo $breadcrumb['text']; ?>
          </a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger">
      <i class="fa fa-exclamation-circle">
      </i> 
      <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;
      </button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div id="exTab1" class="row">	
        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="fa fa-pencil">
            </i> 
            <?php echo $text_form; ?>
          </h3>
        </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
          <ul  class="nav nav-tabs">
            <li class="active">
              <a  href="#1a" data-toggle="tab">
                <?php echo $tab_general; ?>
              </a>
            </li>
            <li>
              <a href="#2a" data-toggle="tab">
                <?php echo $tab_data; ?>
              </a>
            </li>
						<li>
              <a href="#3a" data-toggle="tab">
                <?php echo $tab_question; ?>
              </a>
            </li>
          </ul>
			<div class="tab-content clearfix">
				<div class="tab-pane active" id="1a">
					<ul class="nav nav-tabs" id="language">
						<?php foreach ($languages as $language) { ?>
						<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<?php foreach ($languages as $language) { ?>
						<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for=	"input-package-title">
									<?php echo $lable_title_name;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][title]" value="<?php if(isset($variation_desription[$language['language_id']]['title'])){echo $variation_desription[$language['language_id']]['title']; }?>" placeholder="<?php echo $entry_title_name;?>" id="input-package-titl" class="form-control" />
									<?php if(isset($error_title[$language['language_id']])) { ?>
									<div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_description;?>
								</label>
								<div class="col-sm-10">
									<textarea name="variation_desription[<?php echo $language[	'language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description" class="form-control summernote"><?php if(isset($variation_desription[$language['language_id']]['description'])) { echo $variation_desription[$language['language_id']]['description']; }?></textarea>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_meta_title;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][meta_title]" value="<?php if(isset($variation_desription[$language['language_id']]['meta_title'])){echo $variation_desription[$language['language_id']]['meta_title']; }?>" placeholder="<?php echo $entry_meta_title;?>" id="input-package-titl" class="form-control" />
									<?php if(isset($error_meta_title[$language['language_id']])) { ?>
									<div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_meta_description;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][meta_description]" value="<?php if(isset($variation_desription[$language['language_id']]['meta_description'])){echo $variation_desription[$language['language_id']]['meta_description']; }?>" placeholder="<?php echo $entry_meta_description;?>" id="input-package-titl" class="form-control" />
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_meta_keyword;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][meta_keyword]" value="<?php if(isset($variation_desription[$language['language_id']]['meta_keyword'])){echo $variation_desription[$language['language_id']]['meta_keyword']; }?>" placeholder="<?php echo $entry_meta_keyword;?>" id="input-package-titl" class="form-control" />
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_SEO_keyword;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][seo_keyword]" value="<?php if(isset($variation_desription[$language['language_id']]['seo_keyword'])){echo $variation_desription[$language['language_id']]['seo_keyword']; }?>" placeholder="<?php echo $entry_SEO_keyword;?>" id="input-package-titl" class="form-control" />
									<?php if(isset($error_Industry_Name[$language['language_id']])) { ?>
									<div class="text-danger"></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_tags;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][tag]" value="<?php if(isset($variation_desription[$language['language_id']]['tag'])){echo $variation_desription[$language['language_id']]['tag']; }?>" placeholder="<?php echo $entry_tags;?>" id="input-package-titl" class="form-control" />
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_experience;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][experience]" value="<?php if(isset($variation_desription[$language['language_id']]['experience'])){echo $variation_desription[$language['language_id']]['experience']; }?>" placeholder="<?php echo $entry_experience;?>" id="input-package-titl" class="form-control" />
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_salary;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][salary]" value="<?php if(isset($variation_desription[$language['language_id']]['salary'])){echo $variation_desription[$language['language_id']]['salary']; }?>" placeholder="<?php echo $entry_salary;?>" id="input-package-titl" class="form-control" />
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $lable_url;?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][url]" value="<?php if(isset($variation_desription[$language['language_id']]['url'])){echo $variation_desription[$language['language_id']]['url']; }?>" placeholder="<?php echo $entry_url;?>" id="input-package-titl" class="form-control" />
								</div>
							</div>
						</div>
							<?php } ?>
					</div>
				</div>
				<!--- data tab --->
				<div class="tab-pane" id="2a">
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-parent"><?php echo $lable_country; ?></label>
						<div class="col-sm-10">
							<select name="country_id" class="form-control">
								<?php foreach($countrys as $result){ ?>
								<?php if($country_id == $result['country_id']){ ?>
								<option value="<?php echo $result['country_id'];?>" selected="selected"><?php echo $result['name']; ?></option>
								<?php } else{ ?>
								<option value="<?php echo $result['country_id'];?>"><?php echo $result['name']; ?></option>
								<?php } }?>
							</select>
						</div>
					</div> 
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-parent"><?php echo $lable_zone; ?></label>
						<div class="col-sm-10">
							<select name="zone_id" class="form-control">
								<?php foreach($zone as $result){ ?>
								<?php if($zone_id == $result['zone_id']){ ?>
								<option value="<?php echo $result['zone_id'];?>" selected="selected"><?php echo $result['name']; ?></option>
								<?php } else{ ?>
								<option value="<?php echo $result['zone_id'];?>"><?php echo $result['name']; ?></option>
								<?php } }?>
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-package-title">
							<?php echo $lable_city;?></label>
						<div class="col-sm-10">
							<input type="text" name="city" value="<?php echo $city ;?>" placeholder="<?php echo $entry_city;?>" id="input-package-titl" class="form-control"/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-package-title">
							<?php echo $lable_location;?></label>
						<div class="col-sm-10">
							<input type="text" name="location" value="<?php echo $location ;?>" placeholder="<?php echo $entry_location;?>" id="input-package-titl" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-parent"><?php echo $lable_category; ?></label>
						<div class="col-sm-10">
							<input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-parent" class="form-control" />
							<div id="postjob_category" class="well well-sm" style="height: 150px; overflow: auto;">
							<?php if(isset($categories)) 
								{
									foreach($categories as $category)
									{
										?>
										<div id="postjob_category<?php echo $category['category_id']?>">
											<i class="fa fa-minus-circle"></i>
											<?php echo $category['name']?>
											<input type="hidden" name="category_id[]" value="<?php echo $category['category_id']?>">
										</div>
										<?php
									}
								}?>
							</div>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-parent"><?php echo $lable_jobtype; ?></label>
						<div class="col-sm-10">
							<select name="jobtype_id" class="form-control">
								<option selected="" value="0"><?php echo $text_select; ?></option>
								<option <?php if($jobtype_id==1) { echo "selected"; }  ?> value="1"><?php echo $text_part_time; ?></option>
								<option  <?php if($jobtype_id==2) { echo "selected"; } ?> value="2"><?php echo $text_full_time; ?></option>
							</select>
					 </div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-package-title"><?php echo $lable_company;?></label>
						<div class="col-sm-10">
							 <input type="text" name="company_name" value="<?php echo $company_name;?>" placeholder="<?php echo $entry_company; ?>" id="input-parent" class="form-control" />
							<input type="hidden" name="company_id" value="<?php echo $company_id; ?>" />
						 </div>
					</div>
					
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="status">
							<?php echo $lable_status;?>
						</label>
						<div class="col-sm-10">
							<select name="status" id="input-status" class="form-control">
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
				</div>
				<!--- data tab 3 --->
				<div class="tab-pane" id="3a">
					<div class="table-responsive">
						<table id="images" class="table table-striped table-bordered table-hover">
							<thead>
								<td  class="text-center"><?php echo $lable_question; ?></td>
							</thead>
							<tbody id="images">
								<?php $image_row = 0; ?>
									<?php foreach ($question_type as $type){?>
								<tr id="image-row<?php echo $image_row;?>">	
									<td class="text-right">
										<input type="text" name="question_type[<?php echo $image_row; ?>][question]" value="<?php echo $type['question']; ?>" placeholder="<?php echo $entry_question; ?>" class="form-control" />
									</td>
									<td class="text-left">
										<button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="5"></td>
								<td class="text-left"><button type="button" onclick="addExtraoption();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
							</tr>
							<?php $image_row++;?>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;
function addExtraoption() {
	html  = '<tr id="image-row' + image_row + '">';
	
	html += '<td class="text-right"><input type="text" name="question_type[' + image_row + '][question]" value="" placeholder="<?php echo $entry_question; ?>" class="form-control" /></td>';
	
	html += '<td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	image_row++;
}
//--></script>	
<script type="text/javascript"><!--
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					category_id: 0,
					name: '<?php echo $text_none; ?>'
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
		$('input[name=\'category\']').val();
		
		$('#postjob_category' + item['value']).remove();

		$('#postjob_category').append('<div id="postjob_category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_id[]" value="' + item['value'] + '" /></div>');
	}
	
});
$('#postjob_category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>


<script type="text/javascript">
$('input[name=\'company_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=job/company/autocomplete&token=<?php echo $token; ?>&filter_full_name=' +  encodeURIComponent(request),
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
		$('input[name=\'company_name\']').val(item['label']);
		$('input[name=\'company_id\']').val(item['value']);
	}
});
</script>
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script> 	
<?php echo $footer; ?>