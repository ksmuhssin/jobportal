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
<div class="container jobdetail">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
        <div class="col-sm-4">
			<!--static code start-->
			<img src="image/b2.jpg" alt="b2" title="b2" class="img-responsive" />
			<!--static code end-->
			<div class="left-side">
				<input type="hidden" name="job_id" value="1">
				<ul class="list-unstyled">
					<li>
						<h5><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $entry_location; ?></h5>
						<p> <?php echo $city; ?> , <?php echo $location; ?></p>
					</li>
					<li>
						<h5><i class="fa fa-money" aria-hidden="true"></i> <?php echo $entry_salary;?></h5>
						<p><?php echo $salary; ?></p>
					</li>
					<li>
						<h5><i class="fa fa-shield" aria-hidden="true"></i> <?php echo $entry_experience;?></h5>
						<p><?php echo $experience; ?></p>
					</li>
					<li>
						<h5><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $entry_posted; ?></h5>
						<p><?php echo $date_added; ?></p>
					</li>
				</ul>
			</div>
		</div>
        <div class="col-sm-8 paddleft content">
			<h2><?php echo $title; ?></h2>
			<ul class="list-inline time">
				<li>
					<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $type; ?></a>
				</li>
			</ul>
			<h5><?php echo $entry_job_ds; ?></h5>
			<p><span><?php echo $description; ?></span></p>
			<!--static code start-->
			<button type="button" class="btn btn-info" data-toggle="collapse" data-parent=".accordion" href="#collapse1"><?php echo $button_apply_this; ?></button>
			<div class="clearfix"></div>
				<div id="collapse1" class="panel-collapse collapse job-form col-md-12 col-sm-12 col-xs-12">
					<div class="border"></div>
					<div class="border1"></div>
					<form class="form-horizontal" method="post">
						<fieldset>
							<div class="form-group">
								<div class="col-sm-6">
									<label><?php echo $entry_firstname; ?></label>
									<input class="form-control" placeholder="Type your first name" id="input-name" value="" name="firstname" type="text">
								</div>
								<div class="col-sm-6">
									<label><?php echo $entry_lastname; ?></label>
									<input class="form-control" placeholder="Type your last name" id="input-lastname" value="" name="lastname" type="text">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-6">
									<label><?php echo $entry_email; ?></label>
									<input class="form-control" id="input-email" placeholder="Enter your email address" value="" name="email" type="text">
								</div>
								<div class="col-sm-6">
									<label><?php echo $entry_add_cv; ?></label>
									<div class="browse">
										<input name="file" id="file" class="inputfile" type="file">
										<label for="file"><?php echo $entry_choose_file; ?></label>
									</div>
									<span>Your CV must be a .doc, .pdf, .docx, .rtf and no bigger than 1Mb</span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<label>Additional information</label>
									<textarea class="form-control" id="input-enquiry" rows="10" name="enquiry" placeholder=""></textarea>
								</div>
							</div>
								
							<div class="button">
								<button type="submit" value="Submit" class="btn btn-primary btnus" >APPLY NOW</button>
							</div>
						</fieldset>
					</form>
				</div>
			<!--static code end-->
		</div>
		<!-- featured start here -->
		<div class="similar col-md-12 col-sm-12 col-xs-12 padd0">
			<!-- similar-jobs start here -->
			<div class="similar-jobs">
				<div class="border"></div>
				<h2><span>Similars</span> JOBS</h2>
				<div class="border1"></div>
			</div>
			<!-- similar-jobs end here -->
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a><img src="<?php echo $banner; ?>" alt="<?php echo $banner; ?>" title="<?php echo $banner; ?>" class="img-responsive" /></a>
						<!--static code start here-->
						<div class="buttons">
							<div class="open-down">
								<button type="button" class="rotate1">
									<i class="fa fa-link" aria-hidden="true"></i>
								</button>
								<button type="button" class="rotate1">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</div>
						</div>
						<!--static code end here-->	
					</div>
					<div class="caption">
						<h4><a href=""><?php echo $title; ?></a></h4>
						<ul class="list-inline">
							<li>
								<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $type; ?></a>
							</li>
							<li>
								<a><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $zone; ?></a>
							</li>
						</ul>
						<p><?php echo $description; ?></p>
					</div>
					<div class="in">
						<button type="button" class="btn btn-info"><?php echo $button_view_more; ?></button>
						<button type="button" class="btn btn-info"><?php echo $button_apply_now; ?></button>
					</div>					
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a><img src="<?php echo $banner; ?>" alt="<?php echo $banner; ?>" title="<?php echo $banner; ?>" class="img-responsive" /></a>
						<div class="buttons">
							<div class="open-down">
								<button type="button" class="rotate1">
									<i class="fa fa-link" aria-hidden="true"></i>
								</button>
								<button type="button" class="rotate1">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="caption">
						<h4><a href=""><?php echo $title; ?></a></h4>
						<ul class="list-inline">
							<li>
								<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $type; ?></a>
							</li>
							<li>
								<a><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $zone; ?></a>
							</li>
						</ul>
						<p><?php echo $description; ?></p>
					</div>
					<div class="in">
						<button type="button" class="btn btn-info"><?php echo $button_view_more; ?></button>
						<button type="button" class="btn btn-info"><?php echo $button_apply_now; ?></button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a><img src="<?php echo $banner; ?>" alt="<?php echo $banner; ?>" title="<?php echo $banner; ?>" class="img-responsive" /></a>
						<div class="buttons">
							<div class="open-down">
								<button type="button" class="rotate1">
									<i class="fa fa-link" aria-hidden="true"></i>
								</button>
								<button type="button" class="rotate1">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="caption">
						<h4><a href=""><?php echo $title; ?></a></h4>
						<ul class="list-inline">
							<li>
								<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $type; ?></a>
							</li>
							<li>
								<a><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $zone; ?></a>
							</li>
						</ul>
						<p><?php echo $description; ?></p>
					</div>
					<div class="in">
						<button type="button" class="btn btn-info"><?php echo $button_view_more; ?></button>
						<button type="button" class="btn btn-info"><?php echo $button_apply_now; ?></button>
					</div>
				</div>
			</div>
			
	</div>
		<!-- featured end here -->
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
