<div class="special">
	<div class="job-candidate">
		<h3><?php echo $heading_title; ?></h3>
		<div class="border"></div>
		<div class="border1"></div>
	</div>
<div class="latestsfeat row owl-carousel">
  <?php foreach ($products as $product) { ?>
      <div class="candidate"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
		<p>Web Designer </p>
		</div>
  <?php } ?>
</div>
</div>
<script>
/*latest products script code start here*/
	 $(".latestsfeat").owlCarousel({
		  items : 1,
         itemsDesktop : [1199, 1],
         itemsDesktopSmall : [979, 1],
         itemsTablet : [768, 1],
         itemsMobile : [479, 1],
		  navigation : true,
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem : true,
		  navigationText: ['<i class="fa fa-angle-left fa1"></i>', '<i class="fa fa-angle-right fa2"></i>'],
		  pagination: false
      });
	/*latest products script code end here*/
</script>