<div class="blog">
  <div class="latest-blog">
    <h1><span style="color: #74C15E;">CAREER</span> BLOG</h1>
    <div class="border"></div>
    <div class="border1"></div>
  </div>
  <div class="row">
	<?php foreach ($latestblogs as $blog) { ?>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="product-thumb">
			<div class="image col-md-6 col-sm-12 col-xs-12">
				<a href="<?php echo $blog['href']; ?>"><img src="<?php echo $blog['thumb']; ?>" alt="<?php echo $blog['name']; ?>" title="<?php echo $blog['name']; ?>" class="img-responsive" /></a>
			</div>
			<div class="caption col-md-6 col-sm-12 col-xs-12">
              <h4><a href="<?php echo $blog['href']; ?>"><?php echo $blog['name']; ?></a></h4>
					<div class="description"><p><?php echo $blog['description']; ?></p></div>
					<div class="icons1">
						<div class="share pull-left">
							<ul class="list-inline">
								<li><i class="fa fa-comment"></i><span class="commentcount"><?php echo $blog['comment'];?> </span></li>
								<li><i class="fa fa-eye"></i><?php echo $blog['viewed']?></li>
							</ul>
						</div>
						<div class="dateadded pull-right"><i><?php echo $blog['date_added']; ?></i></div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
    </div>
</div>