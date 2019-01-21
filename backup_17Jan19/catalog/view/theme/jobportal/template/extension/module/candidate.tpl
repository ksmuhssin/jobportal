<!-- latest start here -->
<div class="row">
  <!-- latest-candidate start here -->
  <div class="latest-candidate">
 	<h1>OUR LATEST CANDIDATES</h1>
	<div class="border"></div>
	<div class="border1"></div>
  </div>
<!-- latest-candidate end here -->
	<div class="latestsfeat owl-carousel">
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
<?php if($columnleft || $columnright){?>
<script type="text/javascript"><!--
$('.latestsfeat').owlCarousel({
	items : 1,
    itemsDesktop : [1000,1],
    itemsDesktopSmall : [900,1],
    itemsTablet: [600,1], 
    itemsMobile : 1, 
	autoPlay: false,
	navigation: true,
	navigationText: ['<i class="fa fa-angle-left fa-5x fa1"></i>', '<i class="fa fa-angle-right fa-5x fa2"></i>'],
	pagination:false
});
--></script>
<?php } elseif($contentbottom || $columntop){?>
<script type="text/javascript"><!--
$('.latestsfeat').owlCarousel({
	items : 6,
    itemsDesktop : [1199, 6],
    itemsDesktopSmall : [979, 4],
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



