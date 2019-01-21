<div class="our-partner">
	<h1><span style="color: #74C15E;">OUR</span> PARTNERS</h1>
	<div class="border"></div>
	<div class="border1"></div>
</div>
<div id="carousel<?php echo $module; ?>" class="owl-carousel">
  <?php foreach ($banners as $banner) { ?>
  <div class="item text-center">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#carousel<?php echo $module; ?>').owlCarousel({
	items : 5,
		itemsDesktop : [1199, 4],
		itemsDesktopSmall : [979, 3],
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
