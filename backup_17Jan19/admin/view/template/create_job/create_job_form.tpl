<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-job" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-job" class="form-horizontal">
		
		
		<div class="tabbable boxed parentTabs">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li class=""><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          </ul>
		  
		  
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
               
			   <div class="tabbable">
			   
			   
			   <ul class="nav nav-tabs" id="language">
                  <?php foreach ($languages as $language) { ?>
                  <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                  <?php } ?>
                </ul>
               <div class="tab-content">
			   <?php foreach ($languages as $language) { ?>
			    <div class="tab-pane fade active in" id="language<?php echo $language['language_id']; ?>">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text"  name="job_desc[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($job_desc[$language['language_id']]) ? $job_desc[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-total-page" class="form-control" />
                  </div>
                </div>
              	<div class="form-group">
	                <label class="col-sm-2 control-label" for="input-description"><?php echo $entry_description; ?></label>
	                <div class="col-sm-10">
	                  <textarea type="text" name="job_desc[<?php echo $language['language_id']; ?>][description]" value="<?php echo isset($job_desc[$language['language_id']]) ? $job_desc[$language['language_id']]['description'] : ''; ?>" placeholder="<?php echo $entry_description; ?>" id="input-description" class="form-control summernote" ><?php echo isset($job_desc[$language['language_id']]) ? $job_desc[$language['language_id']]['description'] : ''; ?></textarea>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_tag; ?></label>
	                <div class="col-sm-10">
	                  <input type="text" name="job_desc[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($job_desc[$language['language_id']]) ? $job_desc[$language['language_id']]['tag'] : ''; ?>" placeholder="<?php echo $entry_tag; ?>" id="input-tag" class="form-control" />
	                </div>
	            </div>    
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_meta_title; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="job_desc[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($job_desc[$language['language_id']]) ? $job_desc[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta_title" class="form-control" />
                 </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_experience; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="job_desc[<?php echo $language['language_id']; ?>][experience]" value="<?php echo isset($job_desc[$language['language_id']]) ? $job_desc[$language['language_id']]['experience'] : ''; ?>" placeholder="<?php echo $entry_experience; ?>" id="input-experience" class="form-control" />
                </div>
              </div>
			  </div>
                <?php } ?>
            
			</div>
			</div>
			</div>
			
			
            <div class="tab-pane" id="tab-data">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_email; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                	<label class="col-sm-2 control-label" for="input-category"><?php echo $entry_category?></label>
                  	<div class="col-sm-10">
                    	<input type="text" name="category" value="<?php echo $category?>" placeholder="" id="" class="form-control" />
                    	<input type="hidden" name="category_id" value="<?php echo $category_id ?>"  id="" class="form-control" />
                  </div>
                </div>
				
				  <div class="form-group">
                	<label class="col-sm-2 control-label" for="input-category">Company Name</label>
                  	<div class="col-sm-10">
                    	<input type="text" name="company_name" value="<?php echo $company_id; ?>" placeholder="" id="" class="form-control" />
                    	<input type="hidden" name="company_id" value="<?php echo $company_id; ?>"  id="" class="form-control" />
                  </div>
                </div>
				
				
                <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_application; ?></label>
	                <div class="col-sm-10">
	                  <input type="text" name="url" value="<?php echo $url; ?>" placeholder="<?php echo $entry_application; ?>" id="input-application" class="form-control" />
	                </div>
              	</div>
                <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_salary; ?></label>
	                <div class="col-sm-10">
                  	<input type="text" name="salary" value="<?php echo $salary ?>" placeholder="<?php echo $entry_salary; ?>" id="input-salary" class="form-control" />
                 </div>
              	</div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_location; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="location" value="<?php echo $location ?>" placeholder="<?php echo $entry_location; ?>" id="input-author-name" class="form-control" />
                   </div>
                </div>
              	<div class="form-group">
                	<label class="col-sm-2 control-label"><?php echo $entry_banner; ?></label>
                	<div class="col-sm-10"><a href="" id="thumb-banner" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  		<input type="hidden" name="banner" value="<?php echo $banner; ?>" id="input-banner" />
               		</div>
              	</div>
                <div class="form-group ">
                	<label class="col-sm-2 control-label" for="input-password"><?php echo $entry_jobtype_id; ?></label>
                  	<div class="col-sm-10">
                    	<select name="jobtype_id" id="jobtype_id" class="form-control">
	                        <?php if ($jobtype_id=='1') { ?>
	                        <option value="1" selected="selected"><?php echo $text_fultime; ?></option>
	                        <option value="0"><?php echo $text_parttime; ?></option>
	                        <?php } else if ($jobtype_id=='0') { ?>
	                        <option value="1"><?php echo $text_fultime; ?></option>
	                        <option value="0" selected="selected"><?php echo $text_parttime; ?></option>
	                        <?php }else{ ?>
	                        <option value="1" selected="selected"><?php echo $text_fultime; ?></option>
	                        <option value="0"><?php echo $text_parttime; ?></option>
	                        <?php } ?>
                    	</select>
                  </div>
              </div>
			  
			  <div class="form-group ">
                	<label class="col-sm-2 control-label" for="input-password">Status</label>
                  	<div class="col-sm-10">
                    	<select name="job_status" id="job_status" class="form-control">
	                        <?php if ($job_status=='1') { ?>
	                        <option value="1" selected="selected">Enable</option>
	                        <option value="0">Disable</option>
	                        <?php } else if ($jobtype_id=='0') { ?>
	                        <option value="1">Enable</option>
	                        <option value="0" selected="selected">Disable</option>
	                        <?php }else{ ?>
	                        <option value="1" selected="selected">Enable</option>
	                        <option value="0">Disable</option>
	                        <?php } ?>
                    	</select>
                  </div>
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

<script type="text/javascript"><!--//tab show
$('#language a:first').tab('show');
//--></script>

<script type="text/javascript"><!--

$('input[name=\'category\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=job/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
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
    $('input[name=\'category\']').val(item['label']);
    $('input[name=\'category_id\']').val(item['value']);
  }
});

$('input[name=\'company_name\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=job/company/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
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


//--></script>

<?php echo $footer; ?>
