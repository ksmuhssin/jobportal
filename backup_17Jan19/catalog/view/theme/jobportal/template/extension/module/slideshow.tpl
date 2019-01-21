<div class="slider-main">
<div id="slideshow<?php echo $module; ?>" class="owl-carousel" style="opacity: 1;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>

    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
      
  </div>
    
  <?php } ?>
    
</div>
		<!--search code start here-->
			<div class="slide-detail">
				<div class="container">
					<div class="slider-caption">
						<div class="off"></div>
						<h1><?php echo $text_registerfind; ?></h1>
							<!--category code start here-->
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input name="keyword_search" class="form-control" value="<?php echo $keyword_search?>" placeholder="Keyword" type="text">
							</div>
							<!--category code end here-->
							<!--location code start here-->
							<div class="col-md-4 col-sm-4 col-xs-12">
							<select name="job_filter"id="input-limit" class="form-control selectpicker" >
							<option value=""><?php echo $text_select?></option>
							<?php foreach($categories as $category){ ?>
							<?php if($category_id == $category['category_id']){ ?>
							<option value="<?php echo $category['category_id'];?>" selected="selected"><?php echo $category['name']; ?></option>
							<?php } else{ ?>
							<option value="<?php echo $category['category_id'];?>"><?php echo $category['name']; ?></option>
							<?php } }?>
							</select>
							</div>
							<!--location code end here-->
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="input-group">
									<input name="filter_location" class="form-control" value="<?php echo $filter_location?>" placeholder="Job Location" type="text">
									<span>
<button type="button" class="btnsrch button-filter"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
					</div>
				</div>
			</div>
			<!--search code end here-->
</div>
<script type="text/javascript"><!--
$('#slideshow<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: 3000,
	singleItem: true,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: true
});
--></script>

<script type="text/javascript"><!--
   $('.button-filter').on('click', function() {
	var url = 'index.php?route=job/joblist';

	var job_filter = $('select[name=\'job_filter\']').val();
	if (job_filter) {
		url += '&job_filter=' + encodeURIComponent(job_filter);
	}

	var keyword_search = $('input[name=\'keyword_search\']').val();
	if (keyword_search) {
		url += '&keyword_search=' + encodeURIComponent(keyword_search);
	}

	var filter_location = $('input[name=\'filter_location\']').val();
	if (filter_location) {
		url += '&filter_location=' + encodeURIComponent(filter_location);
	}

	location = url;
});
</script>