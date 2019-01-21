<!-- Footer start here -->
	<footer class="footer3">
		<div class="container">
			<div class="row">
                <div class="col-sm-5">
                <div class="row">
				<?php if ($informations) { ?>
				<div class="col-sm-6">
					<h5><?php echo $text_information; ?></h5>
						<ul class="list-unstyled">
							<?php foreach ($informations as $information) { ?>
							<li><a href="<?php echo $information['href']; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i><?php echo $information['title']; ?></a></li>
							<?php } ?>
						</ul>
				</div>
				<?php } ?>
				
				<div class="col-sm-6 col-xs-12">
					<h5><?php echo $text_useful; ?></h5>
                       <ul class="list-unstyled">
			<?php foreach ($result as $jobportalname) { ?>
			<li>
				<a href="<?php echo $jobportalname['link']; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
				<?php echo $jobportalname['text']; ?></a>
			</li>
				<?php } ?>
			</ul>
				</div>	
				</div>	
				</div>	
				
				<div class="col-sm-3 col-md-3 col-xs-12 contact">
					<h5><?php echo $text_contact; ?></h5>				
					<ul class="list-unstyled">
						<?php if($address2){?>
						<li>
							<a href="javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $address2; ?></a>
						</li>
                        <?php } ?>
                        <?php if($phoneno){?>
						<li>
							<a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $phoneno; ?></a>
						</li>
                        <?php } ?>
                        <?php if($email){?>
						<li>
							<a href="javascript:void(0)"><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $email; ?></a>
						</li>
                        <?php } ?>
					</ul>	
				</div>	
			
				<div id="mc_embed_signup" class="col-sm-4 col-md-4 col-xs-12">
					<h5><?php echo $text_subscribe;?></h5>
					<p><?php echo $text_stayconnect; ?></p>
					<form action="https://themultimediadesigner.us5.list-manage.com/subscribe/post?u=51c1d0d6e4042dfc6c59a8231&amp;id=0f05c71f05" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate subscribe" target="_blank" novalidate="">
						<div class="form-group">
							<div class="input-group">
								<div class="mc-field-group">
                               <input value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" placeholder="<?php echo $text_emailenter; ?>" aria-required="true" type="email">
                            </div>
							<div id="mce-responses" class="clear">
                                <div class="response alert alert-danger" id="mce-error-response" style="display:none"></div>
                                <div class="response alert alert-success" id="mce-success-response" style="display:none"></div>
                            </div>
                            <div style="position: absolute;" aria-hidden="true"><input name="b_51c1d0d6e4042dfc6c59a8231_0f05c71f05" tabindex="-1" value="" type="text"></div>
								<div class="input-group-btn">
                                    <button id="mc-embedded-subscribe" class="btn btn-default btn-lg" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</form>
					<ul class="list-inline socialicon">
						<?php if($fburl){?>
                      <li>
                        <a class="fb round" href="<?php echo $fburl; ?>" target="new"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($twitter){?>
                      <li>
                        <a class="twitter round" href="<?php echo $twitter; ?>" target="new"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($google){?>
                      <li>
                        <a class="google round" href="<?php echo $google; ?>" target="new"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($instagram){?>
                      <li>
                        <a class="insta round" href="<?php echo $instagram; ?>" target="new"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($linkedin){?>
                      <li>
                        <a class="linkedin round" href="<?php echo $linkedin; ?>" target="new"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
					</ul>
				</div>	
			</div>
		</div>
	</footer>
	<div class="powered">
		<div class="container">
            <div class="row">
	            <div class="col-sm-12">
					<?php if ($footericon) { ?>
	              	<a href="<?php echo $home; ?>"><img src="<?php echo $footericon; ?>"  class="img-responsive" alt="logo" title="logo"/></a>
	           		<?php } ?>
	           		<p><?php echo $powered; ?></p>
	            </div>
            </div>
		</div>
	</div>
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