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
<div class="contact-form">
	<div class="container">
		<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<div class="col-md-8 col-sm-8 col-xs-12">
			<?php if ($locations) { ?>
			<h3><?php echo $text_store; ?></h3>
			<div class="panel-group" id="accordion">
			<?php foreach ($locations as $location) { ?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title"><a href="#collapse-location<?php echo $location['location_id']; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $location['name']; ?> <i class="fa fa-caret-down"></i></a></h4>
				  </div>
				  <div class="panel-collapse collapse" id="collapse-location<?php echo $location['location_id']; ?>">
					<div class="panel-body">
					  <div class="row">
						<?php if ($location['image']) { ?>
						<div class="col-sm-3"><img src="<?php echo $location['image']; ?>" alt="<?php echo $location['name']; ?>" title="<?php echo $location['name']; ?>" class="img-thumbnail" /></div>
						<?php } ?>
						<div class="col-sm-3"><strong><?php echo $location['name']; ?></strong><br />
						  <address>
						  <?php echo $location['address']; ?>
						  </address>
						  <?php if ($location['geocode']) { ?>
						  <a href="https://maps.google.com/maps?q=<?php echo urlencode($location['geocode']); ?>&hl=<?php echo $geocode_hl; ?>&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
						  <?php } ?>
						</div>
						<div class="col-sm-3"> <strong><?php echo $text_telephone; ?></strong><br>
						  <?php echo $location['telephone']; ?><br />
						  <br />
						  <?php if ($location['fax']) { ?>
						  <strong><?php echo $text_fax; ?></strong><br>
						  <?php echo $location['fax']; ?>
						  <?php } ?>
						</div>
						<div class="col-sm-3">
						  <?php if ($location['open']) { ?>
						  <strong><?php echo $text_open; ?></strong><br />
						  <?php echo $location['open']; ?><br />
						  <br />
						  <?php } ?>
						  <?php if ($location['comment']) { ?>
						  <strong><?php echo $text_comment; ?></strong><br />
						  <?php echo $location['comment']; ?>
						  <?php } ?>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			<?php } ?>
		    </div>
		    <?php } ?>
		<div class="form">
			<div class="border"></div>
			<div class="border1"></div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				<fieldset>
				  <legend class="hide"><?php echo $text_contact; ?></legend>
				  <div class="form-group required">
					<div class="col-sm-6">
						<label for="input-name"><?php echo $entry_name; ?></label>
						<input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" />
						<?php if ($error_name) { ?>
							<div class="text-danger"><?php echo $error_name; ?></div>
						<?php } ?>
					</div>
					<div class="col-sm-6">
						<label for="input-email"><?php echo $entry_email; ?></label>
						<input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
						<?php if ($error_email) { ?>
						 <div class="text-danger"><?php echo $error_email; ?></div>
						<?php } ?>
					</div>
				  </div>
				  <div class="form-group required">
					<label class="col-sm-12" for="input-enquiry"><?php echo $entry_enquiry; ?></label>
					<div class="col-sm-12">
					  <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"><?php echo $enquiry; ?></textarea>
					  <?php if ($error_enquiry) { ?>
					  <div class="text-danger"><?php echo $error_enquiry; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <?php echo $captcha; ?>
				</fieldset>
				<div class="buttons">
					<input class="btn btn-primary btnus" type="submit" value="<?php echo $button_submit; ?>" />
				</div>
			</form>
		</div>
			</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<div class="detail col-md-12">
				<div class="border"></div>
				<div class="border1"></div>
				<ul class="list-unstyled">
					<?php if ($image) { ?>
					<li>
						<img src="<?php echo $image; ?>" alt="<?php echo $store; ?>" title="<?php echo $store; ?>" class="img-thumbnail" />
					</li>
					<?php } ?>
					<li>
						<h5><?php echo $store; ?></h5>
						<i class="fa fa-map-marker" aria-hidden="true"></i>
						  <span><?php echo $address; ?></span>
					</li>
					<li>
						<h5><?php echo $text_telephone; ?></h5>
						<i class="fa fa-phone" aria-hidden="true"></i>
						<span><?php echo $telephone; ?></span>
					</li>
					<?php if ($fax) { ?>
					<li>
						<h5><?php echo $text_fax; ?></h5>
						<i class="fa fa-envelope" aria-hidden="true"></i>
						<span><?php echo $fax; ?></span>
					</li>
					<?php } ?>
					<!--static code start-->
					<li>
						<h5>Skype</h5>
						<i class="fa fa-skype" aria-hidden="true"></i>
						<a href="#"><span>Jobs.2017</span></a>
					</li>
					<!--static code end-->
				</ul>
			</div>
            <div class="colright">
            <?php echo $column_right; ?>
            </div>
		</div>
	</div>
	<?php echo $content_bottom; ?></div>
	</div>
    <div class="map">
        <?php echo $mapcode; ?>
    </div>
</div>
<?php echo $footer; ?>
