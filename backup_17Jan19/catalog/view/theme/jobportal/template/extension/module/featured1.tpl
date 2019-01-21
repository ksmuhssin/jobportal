<!-- featured start here -->
<div class="featured-jobs">
	<h1><span style="color:#74C15E;">Featured</span> JOBS</h1>
	<div class="border"></div>
	<div class="border1"></div>
</div>
<div class="row">
	<?php foreach ($jobdetailinfo as $product) { ?>
	<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="product-thumb transition">
			<div class="image">
				<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
				<!--static code start here-->
				<div class="buttons">
					<div class="open-down">
						<a href="<?php echo $product['href']; ?>"><button type="button" class="rotate1">
							<i class="fa fa-link" aria-hidden="true"></i>
						</button></a>
						<a href="<?php echo $product['quick']; ?>" data-toggle="modal" class="quicklink" data-target="#quick_link"><button type="button" class="rotate1">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button></a>
					</div>
				</div>
				<!--static code end here-->	
			</div>
			<div class="caption">
				<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
				<!--static code start here-->
				<ul class="list-inline">
					<li>
					<i class="fa fa-bookmark" aria-hidden="true"></i><?php echo $product['type']; ?>
					</li>
					<li>
					<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $product['location']; ?>
					</li>
				</ul>
				<!--static code end here-->	
				<p><?php echo $product['description']; ?></p>
			</div>
			<!--static code start here-->
			<a href="<?php echo $product['viewhref'];?>"><button type="button" class="btn btn-info"><?php echo $button_view; ?></button></a>
			<a href="<?php echo $product['href']; ?>"><button type="button" class="btn btn-info"><?php echo $button_apply; ?></button></a>
			<!--static code end here-->	
		</div>
	</div>
	<?php } ?>
</div>
<!-- featured end here -->
