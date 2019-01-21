<!-- Footer start here -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<footer>
 <div class="container">
   <div class="bor col-md-12 col-sm-12 col-xs-12 padd0">
	<div id="mc_embed_signup" class="col-sm-5 col-md-5 col-xs-12 subscribe">
	 <h5><?php echo $text_subscribe;?></h5>
     <form action="https://themultimediadesigner.us5.list-manage.com/subscribe/post?u=51c1d0d6e4042dfc6c59a8231&amp;id=0f05c71f05" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
		<div class="form-group">
		  <div class="input-group">
		    <div class="mc-field-group">
               <input value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" placeholder="<?php echo $text_emailenter; ?>" aria-required="true" type="email">
            </div>
            <div class="input-group-btn">
			  <button id="mc-embedded-subscribe" class="btn btn-default btn-lg" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <?php echo $button_subscribe;?></button>
			</div>
            <div id="mce-responses" class="clear">
                <div class="response alert alert-danger" id="mce-error-response" style="display:none"></div>
                <div class="response alert alert-success" id="mce-success-response" style="display:none"></div>
            </div>
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input name="b_51c1d0d6e4042dfc6c59a8231_0f05c71f05" tabindex="-1" value="" type="text"></div>
           </div>
		 </div>
       </form>
	  </div>
	  <div class="col-sm-4 col-md-4 col-xs-12 follow">
		<h5><?php echo $text_followus;?></h5>
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
		<div class="col-sm-3 col-md-3 col-xs-12 need">
		  <h5><?php echo $text_needhelp; ?></h5>
          <h6><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $text_callus; ?><span><?php echo $telephone; ?></span></h6>
		</div>	
	</div>
	<div class="row">
	  <div class="col-sm-3 col-md-3 col-xs-12 matter">
        <?php if ($footericon) { ?>
		  <a href="<?php echo $home; ?>"><img src="<?php echo $footericon; ?>"  class="img-responsive" alt="logo" title="logo"/></a>
		<?php } ?>
		<p><?php echo $aboutusdescrption;?></p>
     </div>
    <div class="col-sm-5 col-xs-12">
    <div class="row">
	 <?php if ($informations) { ?>
     <div class="col-sm-6 col-md-6 col-xs-12">
		<h5><?php echo $text_information; ?></h5> 
		<ul class="list-unstyled">
		  <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $information['title']; ?></a></li>
		  <?php } ?>
		 </ul> 
      </div>	
	  <?php } ?>
	  <div class="col-sm-6 col-md-6 col-xs-12 use">
		 <h5><?php echo $text_useful; ?></h5>
		 <ul class="list-unstyled">
			<?php foreach ($result as $jobportalname) { ?>
			<li>
				<a href="<?php echo $jobportalname['link']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> 
				<?php echo $jobportalname['text']; ?></a>
			</li>
				<?php } ?>
			</ul>
		
 
     </div>
    </div>
    </div>
	 <div class="col-sm-4 col-md-4 col-xs-12">
	 <h5>Get in touch</h5>
	 <div class="touchcandidateemailemail text-success"></div>
	 <div class="touchcandidateemail form-horizontal form">
	 <fieldset>
	 <div class="form-group">
		<div class="col-sm-12">
		  <input class="form-control nameclass" id="input-touchname" placeholder="Name" value="" name="touchname" required="" type="text">
		</div>
	 </div>
	 <div class="form-group">
		<div class="col-sm-12">
		  <input class="form-control emailclass" id="input-touchemail" placeholder="Email Address" value="" name="touchemail" required="" type="text">
		</div>
	  </div>
	  <div class="form-group">
		<div class="input-group col-sm-12">
		  <input type="text" placeholder="Message" id="touchmessage" name="touchmessage" value="" class="form-control big messageclass">
		  <div class="input-group-btn">
			<button name="button" class="btn btn-default btn-lg" id="buttonemail"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
		  </div>
		</div>
       </div>
	   </fieldset>
	   </form>
	</div>	
	</div>	
	</div>
 </div>
</footer>
<div class="powered">
  <div class="container">
	<p><?php echo $powered; ?></p>
 </div>
</div>
<!-- Footer start here -->
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
</script>

<script>
	$('#buttonemail').click(function(){
		$.ajax({
			url: 'index.php?route=common/footer/emailfunction',
			type: 'post',
			data: $('.touchcandidateemail input,touchcandidateemail textarea'),
			dataType: 'json',
			beforeSend: function() {
			},
			success: function(json) {
				

			if (json['success']) {
				var text_success_msg = '<div class="p-3 mb-2 bg-success text-white"></div>';
				$('.touchcandidateemailemail').html(text_success_msg+json['success']);
				$('.messageclass').val('');
				$('.emailclass').val('');
				$('.nameclass').val('');

				
			}
		}
	});
	});
$(document).on('click','.quicklink',function(e) {
	$('#quick_link .modal-content').html('<div class="loader-if centered"></div>');
   $('#quick_link').load($(this).attr('href'));
  
});
</script>




