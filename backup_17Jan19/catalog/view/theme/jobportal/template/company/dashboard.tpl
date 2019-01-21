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
      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
			<legend><?php echo $text_your_details; ?></legend>
			<div class="form-group required">
				<label class="col-sm-12" for="input-fullname"><?php echo $label_full_name; ?></label>
				<div class="col-sm-12">
					<input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="<?php echo $label_full_name; ?>" id="input-fullname" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-email"><?php echo $label_email; ?></label>
				<div class="col-sm-12">
					<input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $label_email; ?>" id="input-email" class="form-control" />
				</div>
			</div>          
        </fieldset>
	   <fieldset id="address" class="">
			<legend><?php echo $text_your_address; ?></legend>
			
			<div class="form-group required">
				<label class="col-sm-12" for="input-address-1"><?php echo $label_address; ?></label>
				<div class="col-sm-12">
					<input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address-1" class="form-control" />
				</div>
			</div>
			<input type="hidden" name="company_id" value="<?php echo $company_id; ?>" >
			<div class="form-group required">
				<label class="col-sm-12" for="input-landline_phone"><?php echo $label_landline_phone; ?></label>
				<div class="col-sm-12">
					<input type="tel" name="landline_phone" value="<?php echo $landline_phone; ?>" placeholder="<?php echo $entry_landline_phone; ?>" id="input-landline_phone" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-cell_phone"><?php echo $label_cell_phone; ?></label>
				<div class="col-sm-12">
					<input type="tel" name="cell_phone" value="<?php echo $cell_phone; ?>" placeholder="<?php echo $entry_cell_phone; ?>" id="input-cell_phone" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-city"><?php echo $label_city; ?></label>
				<div class="col-sm-12">
					<input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-pincode"><?php echo $label_pincode; ?></label>
				<div class="col-sm-12">
					<input type="text" name="pincode" value="<?php echo $pincode; ?>" placeholder="<?php echo $entry_pincode; ?>" id="input-pincode" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-country"><?php echo $label_country; ?></label>
				<div class="col-sm-12">
					<input name="country_id" id="input-country" class="form-control" value="<?php echo $country; ?>">
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-zone"><?php echo $label_zone; ?></label>
				<div class="col-sm-12">
					<input name="zone_id" id="input-country" class="form-control" value="<?php echo $zone; ?>">
				</div>
			</div>
        </fieldset>
		 <fieldset id="company" class="">
          <legend><?php echo $text_company_detail; ?></legend>
			<div class="form-group required">
				<label class="col-sm-12" for="input-company_description"><?php echo $label_company_description; ?></label>
				<div class="col-sm-12">
					<input type="text" name="company_description" value="<?php echo $company_description; ?>" placeholder="<?php echo $entry_company_description; ?>" id="input-company_description" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-no_employees"><?php echo $label_no_employees; ?></label>
				<div class="col-sm-12">
					<input type="text" name="no_employees" value="<?php echo $no_employees; ?>" placeholder="<?php echo $entry_no_employees; ?>" id="input-no_employees" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-12" for="input-company_website"><?php echo $label_company_website; ?></label>
				<div class="col-sm-12">
					<input type="text" name="company_website" value="<?php echo $company_website; ?>" placeholder="<?php echo $entry_company_website; ?>" id="input-company_website" class="form-control" />
				</div>
			</div>
		</fieldset>
        <fieldset>        
			<div class="form-group">		  
				<label class="col-sm-12" for="input-company-image"><?php echo $label_company_image; ?></label>		  
				<div class="col-md-12 col-sm-12 col-xs-12 file text-center ">			
					<div class="imagebox">
						<span id="thumb-image"><img src="<?php echo $thumb; ?>" alt="" title="" height="75" width="75" 	/></span>
					</div>															
				</div>			
			</div>		  		  
        </fieldset>
      </form>
	  </div>
	  </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
	
<?php echo $footer; ?>
