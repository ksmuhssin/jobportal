<!-- browse start here -->
<div class="row">
<div class="browse col-sm-12">
	<div class="browse-jobs">
		<h1>BROWSE JOBS</h1>
		<div class="border"></div>
		<div class="border1"></div>
	</div>
	<?php foreach ($categories as $category) { ?>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<div class="matter">
			<a href="<?php echo $category['href']; ?>">
				<div class="boxbor">
                    <img src="<?php echo $category['thumb']; ?>" alt="category image"/>
					<div class="name"><?php echo $category['name']; ?></div>
				</div>
			</a>
		</div>	
	</div>
	<?php } ?>
</div>
</div>
<!-- browse end here -->
