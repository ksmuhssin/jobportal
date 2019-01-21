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
	  <div class="col-sm-offset-1 col-md-8 col-xs-12">
	  <div class="form">
		<div class="border"></div>
		<div class="border1"></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          	<legend><?php echo $text_your_details; ?></legend>
          	<div class="form-group required">
            	<label class="col-sm-12" for="input-fullname"><?php echo $entry_full_name; ?></label>
            	<div class="col-sm-12">
              		<input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="<?php echo $entry_full_name; ?>" id="input-fullname" class="form-control" />
              		<?php if ($error_full_name) { ?>
              		<div class="text-danger"><?php echo $error_full_name; ?></div>
              		<?php } ?>
            	</div>
          	</div>
        
        </fieldset>
	   	<fieldset id="address" class="">
          	<legend><?php echo $text_your_address; ?></legend>
          
          	<div class="form-group required">
            	<label class="col-sm-12" for="input-address-1"><?php echo $entry_address; ?></label>
            	<div class="col-sm-12">
              		<input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address-1" class="form-control" />
              		<?php if ($error_address) { ?>
              		<div class="text-danger"><?php echo $error_address; ?></div>
              		<?php } ?>
            	</div>
          	</div>
         	<input type="hidden" name="company_id" value="<?php echo $company_id; ?>" >
		 	<div class="form-group required">
            	<label class="col-sm-12" for="input-landline_phone"><?php echo $entry_landline_phone; ?></label>
            	<div class="col-sm-12">
              		<input type="tel" name="landline_phone" value="<?php echo $landline_phone; ?>" placeholder="<?php echo $entry_landline_phone; ?>" id="input-landline_phone" class="form-control" />
              		<?php if ($error_landline_phone) { ?>
              		<div class="text-danger"><?php echo $error_landline_phone; ?></div>
              		<?php } ?>
            	</div>
          	</div>
		   	<div class="form-group required">
            	<label class="col-sm-12" for="input-cell_phone"><?php echo $entry_cell_phone; ?></label>
            	<div class="col-sm-12">
              		<input type="tel" name="cell_phone" value="<?php echo $cell_phone; ?>" placeholder="<?php echo $entry_cell_phone; ?>" id="input-cell_phone" class="form-control" />
              		<?php if ($error_cell_phone) { ?>
              		<div class="text-danger"><?php echo $error_cell_phone; ?></div>
              		<?php } ?>
            	</div>
          	</div>

          	<div class="form-group required">
				<label class="col-sm-12" for="input-officeopen"><?php echo $entry_officeopen; ?></label>
				<div class="col-sm-12">
					<input type="text" name="officeopen" value="<?php echo $officeopen; ?>" placeholder="<?php echo $entry_officeopen; ?>" id="input-officeopen" class="form-control" />
				</div>
			</div>

			<div class="form-group required">
				<label class="col-sm-12" for="input-officeclose"><?php echo $entry_officeclose; ?></label>
				<div class="col-sm-12">
					<input type="text" name="officeclose" value="<?php echo $officeclose; ?>" placeholder="<?php echo $entry_officeclose; ?>" id="input-officeclose" class="form-control" />
					
				</div>
			</div>



			<div class="form-group required">
				<label class="col-sm-12" for="input-city"><?php echo $entry_city; ?></label>
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
          <div class="form-group">
				<div class="col-md-12">
				<button type="button"  id="addmap" class="btn btn-info"><?php echo $text_map; ?></button>
				     <input type="hidden" name="longitude" value="<?php echo $longitude;?>" id="input-longitude"/>
				    <input type="hidden" name="latitude"  value="<?php echo $latitude;?>"  id="input-latitude"/>
				</div>
			</div>
			<div class="col-md-12" id="map">
                <!--map static-->
				<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $latitude ?>,<?php echo $longitude ?>&amp;key=AIzaSyC9DD1e5jIc81hoZxa9lu9YC08CLGWINdo"></iframe>
                <!--map static-->
          </div>
        </fieldset>
		 <fieldset id="company" class="">
          	<legend><?php echo $text_company_detail; ?></legend>
            <div class="form-group required">
               <label class="col-sm-12" for="input-company_description"><?php echo $label_jobcategory; ?>
               	</label>
				<div class="col-sm-10">
				<input class="form-control" id="input-job" placeholder="e.g. PHP, Web designer, Manager *" value="<?php echo $cat_name ?>" name="jobcategory" type="text">
				<input type="hidden" name="category_id" value="<?php echo $category_id ?>">
               <?php if ($error_jobcategory) { ?>
					<div class="text-danger"><?php echo $error_jobcategory; ?></div>
					<?php } ?>

			</div>
			</div>
			<div class="form-group">
				<label class="col-sm-12" for="input-company_description"><?php echo $entry_company_description; ?></label>
				<div class="col-sm-10">
					<input type="text" name="company_description" value="<?php echo $company_description; ?>" placeholder="<?php echo $entry_company_description; ?>" id="input-company_description" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-no_employees"><?php echo $entry_no_employees; ?></label>
				<div class="col-sm-10">
					<input type="text" name="no_employees" value="<?php echo $no_employees; ?>" placeholder="<?php echo $entry_no_employees; ?>" id="input-no_employees" class="form-control" />
					<?php if ($error_no_employees) { ?>
					<div class="text-danger"><?php echo $error_no_employees; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-company_website"><?php echo $entry_company_website; ?></label>
				<div class="col-sm-10">
					<input type="text" name="company_website" value="<?php echo $company_website; ?>" placeholder="<?php echo $entry_company_website; ?>" id="input-company_website" class="form-control" />
					<?php if ($error_company_website) { ?>
					<div class="text-danger"><?php echo $error_company_website; ?></div>
					<?php } ?>
				</div>
			</div>
		</fieldset>

        <fieldset>
		  <div class="form-group">
		  <label class="col-sm-12" for="input-company-image"><?php echo $entry_company_image; ?></label>
			<div class="col-md-12 col-sm-12 col-xs-12 file text-center ">
				<div class="imagebox">
				<span id="thumb-image"><img src="<?php echo $thumb; ?>" alt="" title="" height="75" width="75" 	/></span>
				</div>
				 <button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
				<input type="hidden" name="company_logo" value="<?php echo $company_logo; ?>" id="input-image" />
				<?php if ($error_company_logo) { ?>
				<div class="text-danger"><?php echo $error_company_logo; ?></div>
				<?php } ?>										
			</div>	
		</div>
        </fieldset>
        <?php echo $captcha; ?>
        <div class="buttons">
            <input type="submit" value="<?php echo $button_update; ?>" class="btn btn-primary btnus"/>
        </div>
      </form>
	  </div>
	  </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

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
		url: 'index.php?route=company/register/country&country_id=' + this.value,
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


<script type="text/javascript">
			
$('button[id^=\'button-upload\']').on('click', function() {
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
				url: 'index.php?route=company/register/upload',
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

$('#addmap').click(function(){
	$.ajax({
		url: 'index.php?route=company/editcompany/getcompaney',
		type: 'post',
		data: $('select[name=\'country_id\'],select[name=\'zone_id\'],input[name=\'city\'],input[name=\'pincode\']'),
		dataType: 'json',
		beforeSend: function() {
				$('#addmap').remove();
		$('.fa-spin ').after('<i class="fa fa-refresh fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
		},
		success: function(json) {
	
			if (json['success']) {
				$('#input-latitude').val(json['lat']);
				$('#input-longitude').val(json['lng']);
				
			}
			$('#map').html("<iframe width='100%' 'height='600' frameborder='0' style='border:0' src='https://www.google.com/maps/embed/v1/place?q="+json['lat']+","+json['lng']+"&amp;key=AIzaSyAF7RhdCijeJ9oKWaSgeZLZmBH4LvngXbk'></iframe>")
	 	
		}


	 });					
	});	
				
</script>

<script type="text/javascript">
$('input[name=\'jobcategory\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=company/register/autocomplete&filter_name=' +  encodeURIComponent(request),
			type: 'GET',
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
		$('input[name=\'jobcategory\']').val(item['label']);
		$('input[name=\'category_id\']').val(item['value']);
	}
});
</script>


	
<?php echo $footer; ?>
