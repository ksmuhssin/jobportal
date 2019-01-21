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
		<div class="canditate-profile">
			<ul class="nav nav-tabs list-inline">
				<li class="">
					<a href="index.php?route=employ/dashboard">PROFILE</a>
				</li>
				<li class="">
					<a href="index.php?route=employ/appliedjob">APPLIED JOBS</a>
				</li>
				<li class="active">
					<a href="index.php?route=employ/postjobs">POST JOBS</a>
				</li>
				<li class="">
					<a href="index.php?route=employ/changepassword">CHANGE PASSWORD</a>
				</li>
			</ul>
		</div>
       <div class="row">
		   <div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="jobs.html"><img class="img-responsive" src="http://192.168.1.3/oct/job/image/cache/catalog/11-160x160.png" alt="p1" title="p1"/></a>	
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
						<h4><a href="">IT Department Manager</a></h4>
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Full Time</a></li>
							<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Chandigarh</a></li>
						</ul>
						<p>There are many variations of passages of lorem Ipsum available [...]</p>
					</div>
					<button type="button" class="btn btn-info" onclick="location.href='jobs.html'">VIEW MORE</button>
					<button type="button" class="btn btn-info" onclick="location.href='apply-job-form.html'">APPLY NOW</button>
				</div>
			</div>
		</div>
		</div>
    </div>
</div>

<?php echo $footer; ?>
