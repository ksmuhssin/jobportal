<?php echo $header; ?>
<div class="bread">
	<div class="container">
		<h2><?php echo $heading_title; ?></h2>
		<div class="bread-box">
		<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		</ul>
	</div>
	</div>
</div>
<div class="container">
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
    <div id="content" class="<?php echo $class; ?> login-form"><?php echo $content_top; ?>
	  <div class="col-sm-offset-3 col-md-6 col-xs-12">
	  <div class="form">
		<div class="border"></div>
		<div class="border1"></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          <legend><?php echo $text_your_details; ?></legend>
          
			<div class="form-group required">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_fullname;?></label>		
				<div class="col-sm-12">
					<input type="text" name="fullname" value="<?php echo $fullname;?>" placeholder="<?php echo $entry_fullname;?>" id="input-package-titl" class="form-control" >
					<?php if ($error_fullname) { ?>
					<div class="text-danger"><?php echo $error_fullname; ?></div>
					<?php } ?>
				</div>
			</div>
			
			<div class="form-group">
				<div class="form-group required">
					<label class="col-sm-6 control-label" for="input-lastname"><?php echo $entry_resume; ?></label>
					<div class="imagebox col-sm-2">
					<span id="thumb-cvimage"><img src="<?php echo $cvthumb; ?>" alt="" title="" height="120" width="120"/></span>
					</div>
					<button type="button" id="button-cvupload" data-loading-text="<?php echo $text_loading; ?>" 
					class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
					<input type="hidden" name="resumelist" value="<?php echo $resumelist; ?>" id="input-cvimage" />
				</div>
			</div>



		<input type="hidden" name="employ_id" value="<?php echo $employ_id; ?>">
			<div class="form-group required">
				<label class="col-sm-12" for="input-email"><?php echo $entry_email; ?></label>
				<div class="col-sm-12">
					<input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
					<?php if ($error_email) { ?>
					<div class="text-danger"><?php echo $error_email; ?></div>
					<?php } ?>
				</div>
			</div>
		  	<div class="form-group required">
                <label class="col-sm-12" for="input-gender">
					<?php echo $entry_gender;?>
                </label>
                <div class="col-sm-12">
					<select class="form-control" value="" id="input-gender" name="gender">
						<option value="">-------- Please Select --------</option>
						<option value="1" <?php if(isset($gender) && $gender=1) { echo "selected"; }?>><?php echo $text_male?></option>
						<option value="0" <?php if(isset($gender) && $gender=0) { echo "selected"; }?>><?php echo $text_female?></option>
					</select>
					<?php if ($error_gender) { ?>
					<div class="text-danger"><?php echo $error_gender; ?></div>
					<?php } ?>
				</div>	 
            </div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_image; ?></label>
			<div class="imagebox col-sm-2">
				<span id="thumb-image"><img src="<?php echo $thumb; ?>" alt="" title="" height="120" width="120"/></span>
			</div>
			<button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" 
			class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
			<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
		</div>
		  
	<div class="form-group required">
		<label class="col-sm-12" for="input-date-available"><?php echo $entry_birth_date; ?></label>
		<div class="col-sm-12">
			<div class="input-group date">
				<input type="text" name="date_of_birth" value="<?php echo $date_of_birth; ?>" placeholder="<?php echo $entry_birth_date; ?>" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" />
				<span class="input-group-btn">
				<button class="btn btn-default" id="btnSubmit" type="button"><i class="fa fa-calendar"></i></button>
				</span>
			</div>
			<?php if ($error_date_of_birth) { ?>
			<div class="text-danger"><?php echo $error_date_of_birth; ?></div>
			<?php } ?>
		</div>
	</div>
        </fieldset>
		
        <fieldset id="address">
          <legend><?php echo $text_your_address; ?></legend>
          
			<div class="form-group required">
				<label class="col-sm-12"><?php echo $entry_address; ?></label>
				<div class="col-sm-12">
					<textarea type="text" name="address" value="" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control"><?php echo $address; ?></textarea>
					<?php if ($error_address) { ?>
					<div class="text-danger"><?php echo $error_address; ?></div>
					<?php } ?>
				</div>
			</div>
		  
			<div class="form-group required">
				<label class="col-sm-12 " for="input-city"><?php echo $entry_city; ?></label>
				<div class="col-sm-12">
					<input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
					<?php if ($error_city) { ?>
					<div class="text-danger"><?php echo $error_city; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-pincode"><?php echo $entry_pincode; ?></label>
				<div class="col-sm-12">
					<input type="text" name="pincode" value="<?php echo $pincode; ?>" placeholder="<?php echo $entry_pincode; ?>" id="input-pincode" class="form-control" />
					<?php if ($error_pincode) { ?>
					<div class="text-danger"><?php echo $error_pincode; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-country"><?php echo $entry_country; ?></label>
				<div class="col-sm-12">
					<select name="country_id" id="input-country" class="form-control">
						<option value=""><?php echo $text_select; ?></option>
						<?php foreach ($countries as $country) { ?>
						<?php if ($country['country_id'] == $country_id) { ?>
						<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
						<?php if ($error_country) { ?>
						<div class="text-danger"><?php echo $error_country; ?></div>
						<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-zone"><?php echo $entry_zone; ?></label>
				<div class="col-sm-12">
					<select name="zone_id" id="input-zone" class="form-control">
					</select>
					<?php if ($error_zone) { ?>
					<div class="text-danger"><?php echo $error_zone; ?></div>
					<?php } ?>
				</div>
			</div>
		    <div class="form-group required">
				<label class="col-sm-12" for="input-mobile_phone"><?php echo $entry_mobile; ?></label>
				<div class="col-sm-12">
					<input type="tel" name="mobile_phone" value="<?php echo $mobile_phone; ?>" placeholder="<?php echo $entry_mobile; ?>" id="input-mobile_phone" class="form-control" />
					 <?php if ($error_mobile_phone) { ?>
					<div class="text-danger"><?php echo $error_mobile_phone; ?></div>
					<?php } ?>
				</div>
			</div>
		  	<div class="form-group required">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_home_phone;?></label>
				<div class="col-sm-12">
					<input type="text" name="home_phone" value="<?php echo $home_phone; ?>" placeholder="<?php echo $entry_home_phone;?>" id="input-package-titl" class="form-control">
					<?php if ($error_home_phone) { ?>
					<div class="text-danger"><?php echo $error_home_phone; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_profissional;?></label>
				<div class="col-sm-12">
					<input type="text" name="profissional" value="<?php echo $profissional; ?>" placeholder="<?php echo $entry_profissional;?>" id="input-profissional" class="form-control">
					<?php if ($error_profissional) { ?>
					<div class="text-danger"><?php echo $error_profissional; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_experience;?></label>
				<div class="col-sm-12">
					<input type="text" name="experience" value="<?php echo $experience; ?>" placeholder="<?php echo $entry_experience;?>" id="input-experience" class="form-control">
					<?php if ($error_experience) { ?>
					<div class="text-danger"><?php echo $error_experience; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12" for="input-package-title"><?php echo $entry_education;?></label>	
				<?php foreach ($languages as $language) { ?>
				<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
					<table id="educations<?php echo $language['language_id']; ?>" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-left"><?php echo $entry_degree; ?></td>
								<td class="text-left"><?php echo $entry_collage; ?></td>
								<td class="text-left"><?php echo $entry_passed; ?></td>
								<td class="text-left"><?php echo $entry_percentage; ?></td>
								<td class="text-left"><?php echo $entry_button; ?></td>
							</tr>
						</thead>
						<tbody>
							<?php $education_row = 0; ?>
							<?php if (isset($education_rowss[$language['language_id']])) { ?>
							<?php foreach ($education_rowss[$language['language_id']] as $education_rows) { ?>
							<tr id="education-row<?php echo $education_row; ?>">
								<td class="text-left">
									<input name="education_rows[<?php echo $language['language_id']; ?>][<?php echo $education_row; ?>][degree]" value="<?php echo $education_rows['degree']; ?>" class="form-control">
								</td>
								
								<td class="text-left">
									<input name="education_rows[<?php echo $language['language_id']; ?>][<?php echo $education_row; ?>][collage]" value="<?php echo $education_rows['collage']; ?>" class="form-control">
								</td>
								
								<td class="text-left">
									<input name="education_rows[<?php echo $language['language_id']; ?>][<?php echo $education_row; ?>][passed_year]" value="<?php echo $education_rows['passed_year']; ?>" class="form-control">
								</td>
								
								<td class="text-left">
									<input name="education_rows[<?php echo $language['language_id']; ?>][<?php echo $education_row; ?>][percentage]" value="<?php echo $education_rows['percentage']; ?>" class="form-control">
								</td>
								 <td class="text-left">
									<button type="button" onclick="$('#education-row<?php echo $education_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
								</td>
							</tr>
							<?php $education_row++; ?>
							<?php } ?>
									<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4"></td>
								<td class="text-left"><button type="button" onclick="addAducation('<?php echo $language['language_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
							</tr>
						</tfoot>
					</table>
				</div>
			<?php } ?>
		</div>	
		<div class="form-group required">
			<label class="col-sm-12" for="input-package-title"><?php echo $entry_additional;?></label>
			<div class="col-sm-12">
				<input type="text" name="interest" value="<?php echo $interest; ?>" placeholder="<?php echo $entry_interest;?>" id="input-additional" class="form-control">
				<?php if ($error_interest) { ?>
				<div class="text-danger"><?php echo $error_interest; ?></div>
				<?php } ?>
			</div>
			<div class="col-sm-12">
				<input type="text" name="career" value="<?php echo $career; ?>" placeholder="<?php echo $entry_career;?>" id="input-additional" class="form-control">
			</div>
			<div class="col-sm-12">
				<input type="text" name="achievement" value="<?php echo $achievement; ?>" placeholder="<?php echo $entry_achievement;?>" id="input-additional" class="form-control">
			</div>
		</div>
        </fieldset>
		
  
        <?php echo $captcha; ?>
		 <?php if ($text_agree) { ?>
		<div class="form-group">
			<div class="col-sm-12 confirmation">
				<label>
					<?php if ($agree) { ?>
					<input type="checkbox" name="agree" value="1" checked="checked" />
					<?php } else { ?>
					<input type="checkbox" name="agree" value="1" />
					<?php } ?>
					 <?php echo $text_agree; ?>
		    	</label>							
			</div>
		</div>
        <div class="buttons">
            &nbsp;
            <input type="submit" value="<?php echo $button_continueupdate; ?>" class="btn btn-primary btnus"/>
        </div>
        <?php } ?>
	   </form>
	  </div>
	  </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<script type="text/javascript"><!--
var education_row = <?php echo $education_row; ?>;
function addAducation(language_id) {
	html  = '<tr id="education-row' + education_row + '">';
	
	html += '<td class="text-right"><input name="education_rows[' + language_id + '][' + education_row + '][degree]" placeholder="<?php echo $entry_degree; ?>" class="form-control"></td>';
	
	html += '<td class="text-right"><input name="education_rows[' + language_id + '][' + education_row + '][collage]" placeholder="<?php echo $entry_collage; ?>" class="form-control"></td>';
	
	html += '<td class="text-right"><input name="education_rows[' + language_id + '][' + education_row + '][passed_year]" placeholder="<?php echo $entry_passed; ?>" class="form-control"></td>';
  	
	html += '<td class="text-right"><input name="education_rows[' + language_id + '][' + education_row + '][percentage]" placeholder="<?php echo $entry_percentage; ?>" class="form-control"></td>';
	
	html += '<td class="text-left"><button type="button" onclick="$(\'#education-row' + education_row  + ', .tooltip\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
   $('#educations' + language_id + ' tbody').append(html);
  education_row++;
}
//--></script>

<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>


<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/account/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>

<script>
$('button[id^=\'button-upload\']').on('click', function() {
	//alert();
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=employ/editemploy/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
						$("#thumb-image").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100"/>');
						$("#input-image").val(json['location1']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

</script>
<script>
$('button[id^=\'button-cvupload\']').on('click', function() {
	//alert();
	var node = this;

	$('#form-cvupload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-cvupload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-cvupload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-cvupload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=employ/editemploy/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-cvupload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
						$("#thumb-cvimage").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100"/>');
						$("#input-cvimage").val(json['location1']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

</script>
<?php echo $footer; ?>
