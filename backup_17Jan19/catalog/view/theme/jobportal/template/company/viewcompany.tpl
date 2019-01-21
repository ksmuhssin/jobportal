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
    <div class="row">
	<?php echo $column_left; ?>		
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="row">
    	<div class="col-sm-3 col-xs-12">
    	  <div class="graphic">
			<h1><?php echo $full_name;?></h1>
			<ul class="list-unstyled">
               <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $address;?>,<?php echo $zonename;?>,<?php echo $countryname;?></li>
               <li><i class="fa fa-clock-o" aria-hidden="true"></i> Open <?php echo $officeopen;?><br>Close <?php echo $officeclose;?></li>
			</ul>
			<div class="map">
				<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $latitude ?>,<?php echo $longitude ?>&amp;key=AIzaSyC9DD1e5jIc81hoZxa9lu9YC08CLGWINdo"></iframe>
			</div>
			<p><?php echo $description;?>.</p>
          </div>
         	
		</div>	
		<!---left part end -->
		<!---right part start -->
    	<div class="col-md-9 col-sm-9 col-xs-12 padd0">
			<div class="employe-logo">
				<img src="<?php echo $thumblogo; ?>" alt="logo" title="logo" class="img-responsive">
			</div>
			<div class="employe-vacancy">
				<p> <?php echo $jobtota; ?><?php echo $entry_vacancies; ?></p>
			</div>

         <?php if(!empty($jobs)){ ?>
		<?php foreach ($jobs as $job) { ?>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="product-thumb transition">
				<div class="image">
					<a href="jobs.html">
						<img class="img-responsive" src="<?php echo $job['banner']; ?>" alt="<?php echo $job['banner']; ?>" title="<?php echo $job['banner']; ?>"/>
					</a>	
					<div class="buttons">
						<div class="open-down">
							<a href="<?php echo $job['href']; ?>"><button type="button" class="rotate1">
								<i class="fa fa-link" aria-hidden="true"></i>
							</button></a>
							<a href="<?php echo $job['quick']; ?>" data-toggle="modal" class="quicklink" data-target="#quick_link"><button type="button" class="rotate1">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button></a>
						</div>
					</div>		
				</div>		
				<div class="caption">
					<h4><a><?php echo $job['title']; ?></a></h4>
					<ul class="list-inline">
						<li>
							<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $job['type']; ?></a>
						</li>
						<li>
							<a><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $job['location']; ?></a>
						</li>
					</ul>
					<p><?php echo $job['description']; ?> [...]</p>
				</div>
				<a href="<?php echo $job['view']; ?>"><button type="button" class="btn btn-info"><?php echo $button_view; ?></button></a>
				<a href="<?php echo $job['apply']; ?>"><button type="button" class="btn btn-info"><?php echo $button_apply; ?></button></a>
			</div>
		</div>
		<?php } ?>
		<?php } else { ?>
				<p><?php echo $text_no_results; ?></p>
				<?php } ?>
				
					

		</div>
        </div>
          <div class="clearfix"></div>
          <div class="row">
				<div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
				<div class="col-sm-12 text-right"><?php echo $results; ?></div>
			</div>
	
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
