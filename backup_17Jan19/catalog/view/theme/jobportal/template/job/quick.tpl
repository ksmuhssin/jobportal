<div class="modal-dialog modal-lg">
 <div class="modal-content">
  <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="row">
      <div id="content" class="jobdetail">
        <div class="col-sm-4">
			<img src="<?php echo $banner;?>" alt="b2" title="b2" class="img-responsive" />
			<div class="left-side">
			  <input type="hidden" name="job_id" value="1">
              <ul class="list-unstyled">
				<li><h5><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $entry_location; ?></h5>
                <p><?php echo $location; ?></p>
				</li>
				<li><h5><i class="fa fa-money" aria-hidden="true"></i> <?php echo $entry_salary;?></h5>
				<p><?php echo $salary; ?></p>
				</li>
				<li>
				<h5><i class="fa fa-shield" aria-hidden="true"></i> <?php echo $entry_experience;?></h5>
				<p><?php echo $experience; ?></p>
				</li>
				<li>
				<h5><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $entry_posted; ?></h5>
				<p><?php echo $date_added; ?></p>
				</li>
              </ul>
			</div>
		</div>
        <div class="col-sm-8 paddleft content">
		 <h2><?php echo $title; ?></h2>
		 <ul class="list-inline time">
		  <li>
			<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $type; ?></a>
           </li>
		 </ul>
		 <h5><?php echo $entry_job_ds; ?></h5>
		 <p><span><?php echo $description; ?></span></p>
		 <?php if(isset($Logged)){ ?>
		 <button type="button" class="btn btn-info" data-toggle="collapse" data-parent=".accordion" href="#collapse1"><?php echo $button_apply_this; ?></button>
		 <div id="collapse1" class="panel-collapse collapse job-form col-md-12 col-sm-12 col-xs-12">
		   <div class="border"></div>
           <div class="border1"></div>
           <form class="form-horizontal" method="post">
			<fieldset>
			  <div class="form-group">
				<div class="col-sm-6">
				  <label><?php echo $entry_firstname; ?></label>
				  <input class="form-control" placeholder="Type your first name" id="input-name" value="" name="firstname" type="text">
				  <input type="hidden" name="job_id" value="<?php echo $job_id?>">
				</div>
				<div class="col-sm-6">
				  <label><?php echo $entry_lastname; ?></label>
				  <input class="form-control" placeholder="Type your last name" id="input-lastname" value="" name="lastname" type="text">
				</div>
             </div>
			 <div class="form-group">
                <div class="col-sm-6">
				  <label><?php echo $entry_email; ?></label>
				  <input class="form-control" id="input-email" placeholder="Enter your email address" value="" name="email" type="text">
				 </div>
				 <div class="col-sm-6">
				   <label><?php echo $entry_add_cv; ?></label>
				  <div class="browse">
					<div class="imagebox col-sm-6">
					 <span id="thumb-image"><img src="<?php echo $cv; ?>" alt="" title="" height="120" width="120"/></span>
					</div>
					<button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>"class="btn btn-default">
					<i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
					<input type="" name="cv" value="<?php echo $cv; ?>" id="input-image" readonly/>
				  </div>
				 </div>
			</div>
			<div class="form-group">
			  <div class="col-sm-12">
				<label>Additional information</label>
				<textarea class="form-control" id="input-enquiry" rows="10" name="information" placeholder=""></textarea>
				</div>
							</div>
								
							<div class="button">
								<button type="submit" value="Submit" class="btn btn-primary btnus"> 
									<?php echo $button_apply_now;?>
								</button>
							</div>
						</fieldset>
					</form>
				</div>
			
			<?php } elseif(isset($companylogged)) {  ?>
			 <a href="<?php echo $empolylinksd;?>"> <button type="button" class="btn btn-info hide" ><?php echo $button_apply_this; ?></button></a>
			<?php } else { ?>
			 <a href="<?php echo $empolylinksd;?>"> <button type="button" class="btn btn-info" ><?php echo $button_apply_this; ?></button></a>
			<?php }  ?>
			 <!---form------>
			<div class="clearfix"></div>
			<?php if (isset($applyjob)) { ?>
		<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $applyjob; ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	<?php } ?>

  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
		</div>
			<!-- featured end here -->
     </div>
    </div>
 </div>
</div>
</div>

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
				url: 'index.php?route=job/jobdetail/upload',
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
