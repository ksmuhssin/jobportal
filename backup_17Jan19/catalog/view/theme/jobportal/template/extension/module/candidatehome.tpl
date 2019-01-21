<!-- latest start here -->
<div class="row">
  <!-- latest-candidate start here -->
  <div class="latest-candidate">
 	<h1>OUR LATEST CANDIDATES</h1>
	<div class="border"></div>
	<div class="border1"></div>
  </div>
<!-- latest-candidate end here -->
	<div id="latestsfeatss" class="owl-carousel">
	 <?php if(isset($employs_infos)){ ?>
		<?php  foreach($employs_infos as $employs_info){?>
		<div class="item">
			<div class="col-sm-12 col-xs-12">
				<div class="candidate">
					   <a href="<?php echo $employs_info['href']?>"><img src="<?php echo $employs_info['image']?>" class="img-responsive" alt="cand-1" title="<?php echo $employs_info['fullname']?>" />
					   </a>
					 	<h1><?php echo $employs_info['fullname']?></h1>
					   <p><?php echo $employs_info['profissional']?> </p>
				</div>
			</div>
		</div>
		  <?php } }?>	
	</div>
</div>

<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<script>
/*latest products script code start here*/
	 $("#latestsfeatss").owlCarousel({
		  items : 6,
         itemsDesktop : [1199, 1],
         itemsDesktopSmall : [979, 1],
         itemsTablet : [768, 1],
         itemsMobile : [479, 1],
		  navigation : true,
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem : false,
		  navigationText: ['<i class="fa fa-angle-left fa1"></i>', '<i class="fa fa-angle-right fa2"></i>'],
		  pagination: false
      });
	/*latest products script code end here*/
</script>



