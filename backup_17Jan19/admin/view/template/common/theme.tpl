<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" id="btnSubmit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
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
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
    <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
			 <ul class="nav nav-tabs">
				<li class="active hide"><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a></li>
				<li class="active"><a href="#tab-header" data-toggle="tab"><?php echo $tab_header; ?></a></li>
				<li><a href="#tab-footer"      data-toggle="tab"><?php echo $tab_footer; ?></a></li>
				<li><a href="#tab-socialmedia" data-toggle="tab"><?php echo $tab_socialmedia; ?></a></li>
				<li><a href="#tab-testimonial" data-toggle="tab"><?php echo $tab_testimonial; ?></a></li>
				<li><a href="#tab-jobcategory" data-toggle="tab"><?php echo $tab_jobcategory; ?></a></li>
				<li><a href="#tab-search"      data-toggle="tab"><?php echo $tab_search; ?></a></li>
				<li><a href="#footerelement"   data-toggle="tab"><?php echo $tab_footerelement; ?></a></li>
          	</ul>
			<div class="tab-content">
            	<div class="tab-pane active hide" id="tab-setting">
            		<div class="form-group hide">
		            	<label class="col-sm-2 control-label"><?php echo $entry_package; ?></label>
		                <div class="col-sm-10">
		                  <label class="radio-inline">
		                    <?php if ($jobportal_package) { ?>
		                    <input type="radio" name="jobportal_package" value="1" checked="checked" />
		                    <?php echo $text_yes; ?>
		                    <?php } else { ?>
		                    <input type="radio" name="jobportal_package" value="1" />
		                    <?php echo $text_yes; ?>
		                    <?php } ?>
		                  </label>
		                  <label class="radio-inline">
		                    <?php if (!$jobportal_package) { ?>
		                    <input type="radio" name="jobportal_package" value="0" checked="checked" />
		                    <?php echo $text_no; ?>
		                    <?php } else { ?>
		                    <input type="radio" name="jobportal_package" value="0" />
		                    <?php echo $text_no; ?>
		                    <?php } ?>
		                  </label>
		                </div>
		            </div>
				</div>
				<div class="tab-pane active" id="tab-header">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="jobportal_header" value="header1" <?php if($jobportal_header =='header1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h1.png" alt="" /></td>
									<td class="text-left"><?php echo $text_header1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="jobportal_header" value="header2" <?php if($jobportal_header =='header2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h2.png" alt=""/></td>
									<td class="text-left"><?php echo $text_header2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="jobportal_header" value="header3" <?php if($jobportal_header =='header3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h3.png" alt="" /></td>
									<td class="text-left"><?php echo $text_header3; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="jobportal_header" value="header4" <?php if($jobportal_header =='header4') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h4.png" alt=""/></td>
									<td class="text-left"><?php echo $text_header4; ?></td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
				<div class="tab-pane " id="tab-footer">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="jobportal_footer" value="footer1" <?php if($jobportal_footer =='footer1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f1.png" alt=""/></td>
									<td class="text-left"><?php echo $text_footer1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="jobportal_footer" value="footer2" <?php if($jobportal_footer =='footer2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f2.png" alt=""/></td>
									<td class="text-left"><?php echo $text_footer2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="jobportal_footer" value="footer3" <?php if($jobportal_footer =='footer3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f3.png" alt=""/></td>
									<td class="text-left"><?php echo $text_footer3; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="jobportal_footer" value="footer4" <?php if($jobportal_footer =='footer4') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f4.png" alt=""/></td>
									<td class="text-left"><?php echo $text_footer4; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                <div class="tab-pane " id="tab-testimonial">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
							<tr>
							  <td><input  type="radio"  name="jobportal_testimonial" value="testimonial1" <?php if($jobportal_testimonial =='testimonial1') { echo "checked='checked'"; }?> /></td>
							  <td class="text-center"><img src="view/image/testi.png" alt=""/></td>
							 <td class="text-left"><?php echo $text_testimonial1; ?></td>
								</tr>
								<tr>
							<td><input  type="radio"  name="jobportal_testimonial" value="testimonial2" <?php if($jobportal_testimonial =='testimonial2') { echo "checked='checked'"; }?> /></td>
							<td class="text-center"><img src="view/image/testi2.png" alt=""/></td>
							<td class="text-left"><?php echo $text_testimonial1; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                <div class="tab-pane " id="tab-search">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
							<tr>
							  <td><input  type="radio"  name="jobportal_search" value="search1" <?php if($jobportal_search =='search1') { echo "checked='checked'"; }?> /></td>
							  <td class="text-center"><img src="view/image/search.png" alt=""/></td>
							 <td class="text-left"><?php echo $text_search1; ?></td>
								</tr>
								<tr>
							<td><input  type="radio"  name="jobportal_search" value="search2" <?php if($jobportal_search =='search2') { echo "checked='checked'"; }?> /></td>
							<td class="text-center"><img src="view/image/search2.png" alt=""/></td>
							<td class="text-left"><?php echo $text_search2; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                <div class="tab-pane " id="tab-jobcategory">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
							<tr>
							  <td><input  type="radio"  name="jobportal_jobcategory" value="jobcategory1" <?php if($jobportal_jobcategory =='jobcategory1') { echo "checked='checked'"; }?> /></td>
							  <td class="text-center"><img src="view/image/cate1.png" alt=""/></td>
							 <td class="text-left"><?php echo $text_jobcategory1; ?></td>
								</tr>
								<tr>
							<td><input  type="radio"  name="jobportal_jobcategory" value="jobcategory2" <?php if($jobportal_jobcategory =='jobcategory2') { echo "checked='checked'"; }?> /></td>
							<td class="text-center"><img src="view/image/cate2.png" alt=""/></td>
							<td class="text-left"><?php echo $text_jobcategory2; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab-socialmedia">
					<div class="form-group">
					<label class="col-sm-2 control-label" for="input-image"><?php echo $lable_footericon; ?></label>
					<div class="col-sm-10"><a href="" id="thumb-image2" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
					  <input type="hidden" name="jobportal_footericon" value="<?php echo $jobportal_footericon; ?>" id="input-image2" />
					</div>
				</div>
				<div class="form-group">
                <label class="col-sm-2 control-label" for="input-aboutdes"><?php echo $lable_aboutdes; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_aboutdes" value="<?php echo $jobportal_aboutdes; ?>"  id="input-aboutdes" class="form-control" />
                </div>
               </div>
				<div class="form-group">
                <label class="col-sm-2 control-label" for="input-title"><?php echo $lable_title; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_title" value="<?php echo $jobportal_title; ?>"  id="input-name" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-phoneno"><?php echo $lable_phoneno; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_phoneno" value="<?php echo $jobportal_phoneno; ?>"  id="input-phoneno" class="form-control" />
                </div>
               </div>
			    <div class="form-group">
                <label class="col-sm-2 control-label" for="input-mobile"><?php echo $lable_mobile; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_mobile" value="<?php echo $jobportal_mobile; ?>"  id="input-mobile" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-email"><?php echo $lable_email; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_email_soci" value="<?php echo $jobportal_email_soci; ?>"  id="input-email" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-email"><?php echo $lable_address2; ?></label>
                <div class="col-sm-10">
                  <textarea name="jobportal_address2" rows="5" id="input-address2" class="form-control"><?php echo $jobportal_address2; ?></textarea>
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-fburl"><?php echo $lable_fburl; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_fburl" value="<?php echo $jobportal_fburl; ?>"  id="input-fburl" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-google"><?php echo $lable_google; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_google" value="<?php echo $jobportal_google; ?>"  id="input-google" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-twet"><?php echo $lable_twet; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_twet" value="<?php echo $jobportal_twet; ?>"  id="input-twet" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-in"><?php echo $lable_in; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_in" value="<?php echo $jobportal_in; ?>"  id="input-in" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-instagram"><?php echo $lable_instagram; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_instagram" value="<?php echo $jobportal_instagram; ?>"  id="input-instagram" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pinterest"><?php echo $lable_pinterest; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_pinterest" value="<?php echo $jobportal_pinterest; ?>"  id="input-pinterest" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-youtube"><?php echo $lable_youtube; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_youtube" value="<?php echo $jobportal_youtube; ?>"  id="input-youtube" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-blogger"><?php echo $lable_blogger; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_blogger" value="<?php echo $jobportal_blogger; ?>"  id="input-blogger" class="form-control" />
                </div>
               </div>
               <div class="form-group">
                <label class="col-sm-2 control-label" for="input-skype"><?php echo $lable_skype; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_skype" value="<?php echo $jobportal_skype; ?>"  id="input-skype" class="form-control" />
                </div>
               </div>
               <div class="form-group">
				<label class="col-sm-2 control-label" for="input-mapcode"><?php echo $lable_mapcode; ?></label>
				<div class="col-sm-10">
				   <textarea name="jobportal_mapcode" rows="5" placeholder="<?php echo $entry_mapcode; ?>" id="input-mapcode" class="form-control summernote"><?php echo $jobportal_mapcode; ?></textarea>
				 </div>
				</div>
			</div>




			 <div class="tab-pane " id="footerelement">

			 	<div class="form-group">
                <label class="col-sm-2 control-label" for="input-ftitle"><?php echo $lable_titlef; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="jobportal_ftitle" value="<?php echo $jobportal_ftitle; ?>"  id="input-ftitle" class="form-control" />
                </div>
               </div>

				<div class="form-group">
				<label class="col-sm-2 control-label" for="input-email"><?php echo $lable_flicker; ?></label>
				<div class="col-sm-10">
				<textarea name="jobportal_flicker" rows="5" id="input-flicker" class="form-control summernote"><?php echo $jobportal_flicker; ?></textarea>
				</div>
				</div>

                <div class="form-group"> 
                <label class="col-sm-2 control-label" for="input-email"><?php echo $lable_textuseful; ?></label>
				<div class="col-sm-10">	
				<div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                      <td class="text-left"><?php echo $lable_text; ?></td>
                      <td class="text-right"><?php echo $lable_link; ?></td>
                      <td></td>
                    </tr>
                 </thead>
                  <tbody>
                    <?php $theme_row = 0; ?>
                    <?php foreach ($jobportal_usfull as $jobportal_usfulls) { ?>
						<tr id="theme-row<?php echo $theme_row; ?>">
                        <td class="text-right">
                        	<input type="text" name="jobportal_usfull[<?php echo $theme_row; ?>][jobportal_text]" 
                        	value="<?php echo $jobportal_usfulls['jobportal_text']; ?>" placeholder="<?php echo $entry_text; ?>" class="form-control" />

                        </td>
                        <td class="text-right">
                        	<input type="text" name="jobportal_usfull[<?php echo $theme_row; ?>][jobportal_link]" 
                        	value="<?php echo $jobportal_usfulls['jobportal_link']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />

                        </td>
                        <td class="text-left">
                        	<button type="button" onclick="$('#theme-row<?php echo $theme_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                        </td>
                         </tr> 
				
						<?php $theme_row++; ?>
						<?php } ?>
                   </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              </div>
              </div>


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


<script type="text/javascript"><!--
var theme_row = <?php echo $theme_row; ?>;

function addImage() {
	html  = '<tr id="theme-row' + theme_row + '">';
	html += ' <td class="text-right"><input type="text" name="jobportal_usfull[' + theme_row + '][jobportal_text]" value="" placeholder="<?php echo $entry_text; ?>" class="form-control" /></td>' 
	html += '  <td class="text-right"><input type="text" name="jobportal_usfull[' + theme_row + '][jobportal_link]" value="" placeholder="<?php echo $entry_link; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#theme-row' + theme_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	theme_row++;
}
//--></script>
 
<?php echo $footer; ?></div>
