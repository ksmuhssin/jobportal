<!-- Footer start here -->
	<footer class="footer2">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-xs-12 tags">
					<h5>Tags</h5>

					<ul class="list-inline flickers">
						  <?php foreach ($categorieslists as $information) { ?>
						  <li><a href="<?php echo $information['href']; ?>"> <?php echo $information['name']; ?></a></li>
						  <?php } ?>
						</ul>

					</div>	
				<?php if ($informations) { ?>
					<div class="col-sm-3 col-md-3 col-xs-12">
						<h5><?php echo $text_information; ?></h5>
						<ul class="list-unstyled">
						  <?php foreach ($informations as $information) { ?>
						  <li><a href="<?php echo $information['href']; ?>"><i class="fa fa-square" aria-hidden="true"></i> <?php echo $information['title']; ?></a></li>
						  <?php } ?>
						</ul>
					</div>  
				<?php } ?>
					
				<div class="col-sm-3 col-md-3 col-xs-12">
					<h5><?php echo $text_useful; ?></h5>

					 <ul class="list-unstyled">
			<?php foreach ($result as $jobportalname) { ?>
			<li>
				<a href="<?php echo $jobportalname['link']; ?>"><i class="fa fa-square" aria-hidden="true"></i> 
				<?php echo $jobportalname['text']; ?></a>
			</li>
				<?php } ?>
			</ul>
				</div>	
				
			
				<div class="col-sm-3 col-md-3 col-xs-12 contact">
				  <h5><?php echo $text_contact; ?></h5>				
					<ul class="list-unstyled">
						<?php if($address2){?>
						<li>
							<a href="javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $address2; ?>
							</a>
						</li>
                        <?php } ?>
                        <?php if($phoneno){?>
						<li>
							<a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $phoneno; ?>
							</a>
						</li>
                        <?php } ?>
                        <?php if($email){?>
						<li>
							<a href="javascript:void(0)"><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $email; ?>+
							</a>
						</li>
                        <?php } ?>
					</ul>	
				</div>	
			</div>
		</div>
	
	<div class="powered">
		<div class="container">
			<div class="col-md-4 col-sm-4 col-xs-12 padd0">
				<ul class="list-inline socialicon">
					<?php if($fburl){?>
                      <li>
                        <a href="<?php echo $fburl; ?>" target="new"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($twitter){?>
                      <li>
                        <a href="<?php echo $twitter; ?>" target="new"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($google){?>
                      <li>
                        <a href="<?php echo $google; ?>" target="new"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($instagram){?>
                      <li>
                        <a href="<?php echo $instagram; ?>" target="new"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($linkedin){?>
                      <li>
                        <a href="<?php echo $linkedin; ?>" target="new"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
				</ul>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 padd0">
				<p><?php echo $powered; ?></p>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 padd0">
				 <?php if ($footericon) { ?>
                  <a href="<?php echo $home; ?>"><img src="<?php echo $footericon; ?>"  class="img-responsive pull-right" alt="logo" title="logo"/></a>
                <?php } ?>
			</div>
		</div>
	</div>
	</footer>
<!-- Footer end here -->

</body></html>
<div id="quick_link" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script>
$('body').prepend('<a href="#" class="bottom-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>');
	var amountScrolled = 300;
	$(window).on('scroll',function() {
		if ( $(window).scrollTop() > amountScrolled ) {
			$('a.bottom-top').fadeIn('slow');
		} else {
			$('a.bottom-top').fadeOut('slow');
		}
	});
	$('a.bottom-top').on('click',function() {
		$('html, body').animate({
			scrollTop: 0
		}, 700);
		return false;
	});
$(document).on('click','.quicklink',function(e) {
	$('#quick_link .modal-content').html('<div class="loader-if centered"></div>');
   $('#quick_link').load($(this).attr('href'));
  
});
</script>