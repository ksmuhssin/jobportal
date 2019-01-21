<?php echo $header; ?>
<div class="top-breadcrumb">
	<div class="container">
		<h1><?php echo $heading_title; ?></h1>
		<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    	<!-- - new code here  --> 
    <div id="jobdetail">	
    	<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12 hidden-xs">
					<img src="<?php echo $banner;?>" alt="p6" title="p6" class="img-responsive">
					<div class="left-side">
						<ul class="list-unstyled">
							<li>
								<h5><i class="fa fa-map-marker" aria-hidden="true"></i> Location</h5>
								<p><?php echo $location;?></p>
							</li>
							<li>
								<h5><i class="fa fa-money" aria-hidden="true"></i> 
								Salary</h5>
								<p><?php echo $salary;?></p>
							</li>
							<li>
								<h5><i class="fa fa-shield" aria-hidden="true"></i> 
								Experience</h5>
								<p><?php echo $experience;?></p>
							</li>
							<li>
								<h5><i class="fa fa-clock-o" aria-hidden="true"></i> Posted</h5>
								<p><?php echo $date_added;?></p>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="col-md-8 col-sm-8 col-xs-12 paddleft content">
					<h1><?php echo $title;?></h1>
					<ul class="list-inline">
						<li>
							<a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $type;?></a>
						</li>
					</ul>
  				<h5>Job Description</h5>
					<p><span><?php echo $description;?></span>
					</p>

				
				</div>
				<div class="clearfix"></div>
			</div>
        </div>
	  </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>



	
<?php echo $footer; ?>
