<!-- browse start here -->
<div class="browse2">
<div class="browse">
   <div class="row">
      <div class="browse-jobs">
		<div class="border"></div>
		  <h1><span>BROWSE</span> JOBS</h1>
		  <div class="border1"></div>
		</div>
		<div class="col-md-12">
          <ul class="list-inline browse-job">
            <?php foreach ($categories as $category) { ?>
			<li>
		       <a href="<?php echo $category['href']; ?>">
                <img src="<?php echo $category['thumb']; ?>" alt="category image"/><div class="name"><?php echo $category['name']; ?></div>
                </a>
			</li>
            <?php } ?>
           </ul>
		</div>
	</div>
</div>
</div>
<!-- browse end here -->
