<!-- testimonial start here -->
<div class="testimonial2">
<div class="testimonial-main">
  <div class="container">
      <div class="testimonial-jobs">
          <div class="border"></div>
		   <h1><span style="color:#74C15E">Testimonials</span></h1>
    	  <div class="border1"></div>
      </div>
       <div class="row">
      <div class="testimonial1 owl-carousel">
	   <?php foreach ($testimonial as $test) { ?>
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="image">
			<a href="<?php echo $test['bigimage']; ?>">	
			<img src="<?php echo $test['image']; ?>" alt="<?php echo $test['name']; ?>" title="<?php echo $test['name']; ?>" class="img-responsive" /></a>	
         </div>
         <div class="caption">
            <div class="name"><?php echo $test['name']; ?></div>
			<p><i class="fa fa-quote-left" aria-hidden="true"></i><?php echo $test['enquiry'];  ?><span><i class="fa fa-quote-right" aria-hidden="true"></i></span></p>
			<?php if ($test['rating']) { ?>
			<div class="rating">
			<?php for ($i = 1; $i <= 5; $i++) { ?>
			<?php if ($test['rating'] < $i) { ?>
			<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
			<?php } else { ?>
			<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
			<?php } ?>
			<?php } ?>
			</div>
		    <?php } ?>
		 </div>
	   </div>
	<?php } ?>
	</div>
		
		<div class="view_all hide">
			<a href="<?php echo $testlink; ?>" class="btn btn-testi"><?php echo $text_view; ?></a>
		</div>	
		<div class="view_all hide">
			<a href="<?php echo $addlink; ?>" class="btn btn-testi"><?php echo $text_addtesti; ?></a>
		</div>
</div>	
</div>	
</div>	
</div>	
<style>
.testimonial-main{padding:15px 0;margin:10px 0;}
.testimonial-main h1,.information-testimonial_list h2 span{color:<?php echo $headingcolor; ?> !important;}
.testimonial-main .name{color:<?php echo $namecolor; ?>;}
.testimonial-main .caption p{color:<?php echo $descolor; ?>;}
.testimonial-main .firstpart,.leftdesign .caption p{background:<?php echo $contentbg; ?>;}
.testimonial-main .leftdesign .caption p::after{border-color:<?php echo $contentbg; ?> rgba(0, 0, 0, 0);}
.btn-testi{font-size:14px;background:<?php echo $btnbg; ?>;border-color:<?php echo $btnbg; ?>;color:<?php echo $btncolor; ?>;}
.btn-testi:hover{background:<?php echo $btncolor; ?>;border-color:<?php echo $btncolor; ?>;color:<?php echo $btnhovcolor; ?> !important;}
.testimonial-main .owl-carousel .owl-buttons .fa{color:<?php echo $nextprev; ?>;background:<?php echo $nextprevbg; ?>;padding:5px;}
</style>	
<?php if($columnleft || $columnright){?>
<script type="text/javascript"><!--
$('.testimonial1').owlCarousel({
	items : 1,
    itemsDesktop : [1000,1],
    itemsDesktopSmall : [900,1],
    itemsTablet: [600,1], 
    itemsMobile : 1, 
	autoPlay: false,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x fa1"></i>', '<i class="fa fa-chevron-right fa-5x fa2"></i>'],
	pagination:false
});
--></script>
<?php } elseif($contentbottom || $columntop){?>
<script type="text/javascript"><!--
$('.testimonial1').addClass("testimoniallist");
$('.testimonial1').owlCarousel({
	items : 3,
    itemsDesktop : [1199, 3],
    itemsDesktopSmall : [979, 2],
    itemsTablet : [768, 2],
    itemsMobile : [479, 1],
	navigation : true,
	slideSpeed : 300,
	paginationSpeed : 400,
	singleItem : false,
	navigationText: ['<i class="fa fa-angle-left fa1"></i>', '<i class="fa fa-angle-right fa2"></i>'],
	pagination: false
});
--></script>
<?php } ?>
<!-- testimonial end here -->
