<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" id="btnSubmit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
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
<?php if ($success) { ?>
<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
<button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php } ?>
    <div class="panel panel-default">	
        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="fa fa-pencil">
            </i> 
            <?php echo $text_form; ?>
          </h3>
        </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
			<div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title"><?php echo $lable_full_name;?></label>
        <div class="col-sm-10">
          <input type="text" name="full_name" value="<?php echo $full_name;?>"    placeholder="<?php echo $entry_full_name;?>" id="input-package-titl" class="form-control"/>
          <?php if ($error_full_name) { ?>
          <div class="text-danger"><?php echo $error_full_name; ?></div>
          <?php } ?>  
        </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title"><?php echo $lable_company_name;?></label>
        <div class="col-sm-10">
          <input class="form-control" id="input-job" placeholder="e.g. PHP, Web designer, Manager *" value="<?php echo $cat_name ?>" name="jobcategory" type="text">
          <input type="hidden" name="category_id" value="<?php echo $category_id ?>">
        </div>
      </div>
		  <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title"><?php echo $lable_email;?></label>
        <div class="col-sm-10">
          <input type="text" name="email" value="<?php echo $email;?>" placeholder="<?php echo $entry_email;?>" id="input-package-titl" class="form-control"/>
          <?php if ($error_email) { ?>
          <div class="text-danger"><?php echo $error_email; ?></div>
          <?php } ?>
        </div>
      </div>
    	<div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title"><?php echo $lable_password;?></label>
        <div class="col-sm-10">
          <input type="password" id="txtPassword" name="password" value="" placeholder="<?php echo $entry_password;?>" id="input-package-titl" class="form-control"/>
         <?php if ($error_password) { ?>
          <div class="text-danger"><?php echo $error_password; ?></div>
          <?php } ?>
         </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title">
          <?php echo $lable_confirm_password;?></label>
        <div class="col-sm-10">
            <input type="password" id="txtConfirmPassword" name="confirm_password" value="" placeholder="<?php echo $entry_confirm_password;?>" id="input-package-titl" class="form-control"/>
          <?php if ($error_confirm_password) { ?>
           <div class="text-danger"><?php echo $error_confirm_password; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title">
        <?php echo $lable_landline_phone;?></label>
        <div class="col-sm-10">
          <input type="text" name="landline_phone" value="<?php echo $landline_phone;?>" placeholder="<?php echo $entry_landline_phone;?>" id="input-package-titl" class="form-control"/>
        <?php if ($error_landline_phone) { ?>
          <div class="text-danger"><?php echo $error_landline_phone; ?></div>
        <?php } ?>
        </div>
      </div>
			<div class="form-group required">
                <label class="col-sm-2 control-label" for="input-package-title">
                  <?php echo $lable_cell_phone;?></label>
                <div class="col-sm-10">
                    <input type="text" name="cell_phone" value="<?php echo $cell_phone;?>" placeholder="<?php echo $entry_cell_phone;?>" id="input-package-titl" class="form-control"/>
					<?php if ($error_cell_phone) { ?>
                    <div class="text-danger"><?php echo $error_cell_phone; ?></div>
				    <?php } ?>
                </div>
            </div>
			<div class="form-group required">
                <label class="col-sm-2 control-label" for="input-package-title">
                  <?php echo $lable_address;?></label>
                <div class="col-sm-10">
                    <textarea type="text" name="address" value="" placeholder="<?php echo $entry_address;?>" id="input-package-titl" class="form-control"><?php echo $address;?></textarea>
					<?php if ($error_address) { ?>
                    <div class="text-danger"><?php echo $error_address; ?></div>
					<?php } ?>
                </div>
            </div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-customer"><?php echo $lable_country; ?></label>
				<div class="col-sm-10">
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
                  
				</div>
			</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-customer"><?php echo $lable_state; ?></label>
        <div class="col-sm-10">
          <select name="zone_id" id="input-zone" class="form-control">
                </select>
                
        </div>
      </div>
    <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title">
        <?php echo $lable_city;?></label>
        <div class="col-sm-10">
          <input type="text" name="city" value="<?php echo $city;?>" placeholder="<?php echo $entry_city;?>" id="input-package-titl" class="form-control"/>
          <?php if ($error_city) { ?>
          <div class="text-danger"><?php echo $error_city; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-package-title">
                    <?php echo $lable_pincode;?></label>
                <div class="col-sm-10">
                    <input type="text" name="pincode" value="<?php echo $pincode;?>" placeholder="<?php echo $entry_pincode;?>" id="input-package-titl" class="form-control"/>
          <?php if ($error_pincode) { ?>
                    <div class="text-danger"><?php echo $error_pincode; ?></div>
          <?php } ?>
                </div>
            </div>
      <div class="form-group">
        <div class="col-md-10">
        <button type="button"  id="addmap" class="btn btn-info"><?php echo $text_map; ?></button>
       
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="input-longitude"><?php echo $lable_longitude;?></label>
        <div class="col-sm-10">
          <input type="text" name="longitude" value="<?php echo $longitude;?>" placeholder="<?php echo $entry_longitude;?>" id="input-longitude" class="form-control"/>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="input-latitude"><?php echo $lable_latitude;?></label>
        <div class="col-sm-10">
          <input type="text" name="latitude" value="<?php echo $latitude;?>" placeholder="<?php echo $entry_latitude;?>" id="input-latitude" class="form-control"/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="input-officeopen"><?php echo $lable_officeopen; ?></label>
        <div class="col-sm-10">
          <input type="text" name="officeopen" value="<?php echo $officeopen; ?>" placeholder="<?php echo $entry_officeopen; ?>" id="input-officeopen" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="input-officeclose"><?php echo $lable_officeclose; ?></label>
        <div class="col-sm-10">
          <input type="text" name="officeclose" value="<?php echo $officeclose; ?>" placeholder="<?php echo $entry_officeclose; ?>" id="input-officeclose" class="form-control" />          
        </div>
      </div>
			
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-package-title">
        <?php echo $lable_company_website;?></label>
        <div class="col-sm-10">
          <input type="text" name="company_website" value="<?php echo $company_website;?>" placeholder="<?php echo $entry_company_website;?>" id="input-package-titl" class="form-control"/>
          <?php if ($error_company_website) { ?>
          <div class="text-danger"><?php echo $error_company_website; ?></div>
          <?php } ?>
        </div>
      </div>
			<div class="form-group">
                <label class="col-sm-2 control-label" for="input-package-title">
                    <?php echo $lable_no_of_employees;?></label>
                <div class="col-sm-10">
                    <input type="text" name="no_employees" value="<?php echo $no_employees;?>" placeholder="<?php echo $entry_no_of_employees;?>" id="input-package-titl" class="form-control"/>
                </div>
            </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-package-title">
            <?php echo $lable_company_descri;?></label>
            <div class="col-sm-10">
              <textarea type="text" name="company_description"  placeholder="<?php echo $entry_company_descri;?>" id="input-package-titl" class="form-control summernote"><?php echo $company_description;?></textarea>
            
            </div>
        </div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-image"><?php echo $lable_company_image; ?></label>
				<div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
				  <input type="hidden" name="company_logo" value="<?php echo $company_logo; ?>" id="input-company_logo" />
				</div>
          	</div>
	</div>
</div>
        </form>
</div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>
<script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#txtPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
</script>	


<script type="text/javascript">
$('input[name=\'jobcategory\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=job/employ/autocompletecategory&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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


<script>

$('#addmap').click(function(){
  $.ajax({
    url: 'index.php?route=job/company/getcompaney&token=<?php echo $token; ?>',
    type: 'post',
    data: $('select[name=\'country_id\'],select[name=\'zone_id\'],input[name=\'city\'],input[name=\'pincode\'] '),
    dataType: 'json',
    beforeSend: function() {
    $('#addmap').after('<i class="fa fa-refresh fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
    },
    success: function(json) {
    $('.fa-spin').remove();
      if (json['success']) {
        $('#input-latitude').val(json['lat']);
        $('#input-longitude').val(json['lng']);
        
      }
  }


   });          
  }); 
        
</script>
  <script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
  $.ajax({
    url: 'index.php?route=job/company/country&&token=<?php echo $token; ?>&country_id=' + this.value,
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



<?php echo $footer; ?>