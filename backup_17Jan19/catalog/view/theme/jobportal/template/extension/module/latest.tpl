<div class="leftside">
	<div class="latest-jobs">
		<h1><?php echo $heading_title; ?></h1>
		<div class="border"></div>
		<div class="border1"></div>
	</div>
	<div class="row">
	<?php foreach ($jobs as $job) { ?>
		<div class="product-layout col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="job-content">
				<div class="image">
					<a href="<?php echo $job['href']; ?>"><img src="<?php echo $job['banner']; ?>" alt="<?php echo $job['banner']; ?>" title="<?php echo $job['banner']; ?>" class="img-responsive" /></a>
				</div>
				<h4><a href="<?php echo $job['href']; ?>"><?php echo $job['title']; ?></a></h4>
					<!--static code start here-->
					<ul class="list-inline">
						<li>
							<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $job['type']; ?></a>
						</li>
						<li>
							<a><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $job['zone']; ?></a>
						</li>
					</ul>
					<!--static code end here-->	
					<a href="<?php echo $job['href']; ?>"><?php echo $button_apply; ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
			</div>
		</div>
	<?php } ?>
	</div>
</div>