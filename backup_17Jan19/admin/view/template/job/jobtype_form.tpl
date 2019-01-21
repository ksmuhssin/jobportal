<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
          <div class="tab-content">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_jobtype; ?></label>
						<div class="col-sm-10">
							<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][jobtype]" value="<?php echo isset($variation_desription[$language['language_id']]) ? $variation_desription[$language['language_id']]['jobtype'] : ''; ?>" placeholder="<?php echo $entry_jobtype; ?>" id="input-jobtype<?php echo $language['language_id']; ?>" class="form-control" />
							<?php if (isset($error_jobtype[$language['language_id']])) { ?>
							<div class="text-danger"><?php echo $error_jobtype[$language['language_id']]; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-package-title">
							<?php echo $entry_description;?>
						</label>
						<div class="col-sm-10">
							<textarea name="variation_desription[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" value="<?php if(isset($variation_desription[$language['language_id']]['description'])){echo $variation_desription[$language['language_id']]['description']; }?>" id="input-description" class="form-control summernote"><?php if(isset($variation_desription[$language['language_id']]['description'])) { echo $variation_desription[$language['language_id']]['description']; }?></textarea>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-package-title">
							<?php echo $entry_meta_title;?>
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
							<?php echo $entry_meta_description;?>
						</label> 
						<div class="col-sm-10">
							<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][meta_description]" value="<?php if(isset($variation_desription[$language['language_id']]['meta_description'])){echo $variation_desription[$language['language_id']]['meta_description']; }?>" placeholder="<?php echo $entry_meta_description;?>" id="input-package-titl" class="form-control" />
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-package-title">
							<?php echo $entry_meta_keyword;?>
						</label> 
						<div class="col-sm-10">
							<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][meta_keyword]" value="<?php if(isset($variation_desription[$language['language_id']]['meta_keyword'])){echo $variation_desription[$language['language_id']]['meta_keyword']; }?>" placeholder="<?php echo $entry_meta_keyword;?>" id="input-package-titl" class="form-control" />
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-package-title">
							<?php echo $entry_SEO_keyword;?>
						</label> 
						<div class="col-sm-10">
							<input type="text" name="variation_desription[<?php echo $language['language_id']; ?>][seo_keyword]" value="<?php if(isset($variation_desription[$language['language_id']]['seo_keyword'])){echo $variation_desription[$language['language_id']]['seo_keyword']; }?>" placeholder="<?php echo $entry_SEO_keyword;?>" id="input-package-titl" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
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
                <?php } ?>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>	
 </div>
<?php echo $footer; ?>
