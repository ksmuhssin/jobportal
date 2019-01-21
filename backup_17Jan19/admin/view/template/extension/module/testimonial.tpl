<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-testimonial" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
    <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-testimonial" class="form-horizontal">
		<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
				<li><a href="#tab-color" data-toggle="tab"><?php echo $tab_color; ?></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab-general">	
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $label_name; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
					  <?php if ($error_name) { ?>
					  <div class="text-danger"><?php echo $error_name; ?></div>
					  <?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-limit"><?php echo $label_limit; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="limit" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $label_status; ?></label>
					<div class="col-sm-10">
					  <select name="status" id="input-status" class="form-control">
						<?php if ($status) { ?>
						<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						<?php } ?>
					  </select>
					</div>
				</div>
            </div>
				<div class="tab-pane" id="tab-color">
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_bgimage; ?></label>
						<div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
							<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_bgwidth; ?></label>
						<div class="col-sm-10">		
							<div class="col-sm-6 paddleft">
								<input name="testi_bgwidth" value="<?php echo $testi_bgwidth; ?>" placeholder="Width" id="input-bg-width" class="form-control" type="text">
							</div>
							<div class="col-sm-6 paddleft">
								<input name="testi_bgheight" value="<?php echo $testi_bgheight; ?>" placeholder="height" id="input-bg-height" class="form-control" type="text">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_heading_color; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_headingcolor" value="<?php echo $testi_headingcolor; ?>" placeholder="<?php echo $entry_heading_color; ?>" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_name_color; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_namecolor" value="<?php echo $testi_namecolor; ?>" placeholder="<?php echo $entry_name_color; ?>" class="form-control demo" />
						</div>							
					</div>
				
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_des_color; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_descolor" value="<?php echo $testi_descolor; ?>" placeholder="<?php echo $entry_des_color; ?>" class="form-control demo" />
						</div>							
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_btn_bg; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_btnbg" value="<?php echo $testi_btnbg; ?>" placeholder="<?php echo $entry_btn_bg; ?>" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_btn_bghov; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_btnbghov" value="<?php echo $testi_btnbghov; ?>" placeholder="<?php echo $entry_btn_bghov; ?>" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_btn_color; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_btncolor" value="<?php echo $testi_btncolor; ?>" placeholder="<?php echo $entry_btn_color; ?>" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_btn_hovcolor; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_btnhovcolor" value="<?php echo $testi_btnhovcolor; ?>" placeholder="<?php echo $entry_btn_hovcolor; ?>" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_content_bg; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_contentbg" value="<?php echo $testi_contentbg; ?>" placeholder="<?php echo $entry_content_bg; ?>" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_next_prev; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_nextprev" value="<?php echo $testi_nextprev; ?>" placeholder="<?php echo $entry_next_prev; ?>" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $label_next_prev_bg; ?></label>
						<div class="col-sm-10">								
							<input type="text" name="testi_nextprev_bg" value="<?php echo $testi_nextprev_bg; ?>" placeholder="<?php echo $entry_next_prev_bg; ?>" class="form-control demo" />
						</div>							
					</div>
					
				</div>	
			</div>	
         
      </form>
    </div>
  </div>
</div>
</div>
<script src="view/javascript/colorbox/jquery.minicolors.js"></script>
<link rel="stylesheet" href="view/stylesheet/jquery.minicolors.css">

<script type="text/javascript"><!--
		$(document).ready( function() {
			
            $('.demo').each( function() {
               		$(this).minicolors({
					control: $(this).attr('data-control') || 'hue',
					defaultValue: $(this).attr('data-defaultValue') || '',
					inline: $(this).attr('data-inline') === 'true',
					letterCase: $(this).attr('data-letterCase') || 'lowercase',
					opacity: $(this).attr('data-opacity'),
					position: $(this).attr('data-position') || 'bottom left',
					change: function(hex, opacity) {
						if( !hex ) return;
						if( opacity ) hex += ', ' + opacity;
						try {
							console.log(hex);
						} catch(e) {}
					},
					theme: 'bootstrap'
				});
                
            });
			
		});
</script>
<?php echo $footer; ?>
<style>
.paddleft{padding-left:0px;}
.paddright{padding-right:0px;}
</style>
