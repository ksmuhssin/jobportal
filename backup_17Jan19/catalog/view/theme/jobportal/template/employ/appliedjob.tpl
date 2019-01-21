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
					<a href="<?php echo $edashboard; ?>"><?php echo $text_profile; ?></a>
				</li>
				<li class="active">
					<a href="<?php echo $appliedjob; ?>"><?php echo $text_apply; ?></a>
				</li>
				<li class="">
					<a href="<?php echo $editemploy; ?>"><?php echo $text_postjob; ?></a>
				</li>
				<li class="">
					<a href="<?php echo $changepassword; ?>"><?php echo $text_change; ?></a>
				</li>
                <li class="">
					<a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a>
				</li>
			</ul>
		</div>
       <div class="row">
       	<?php if(!empty($applied_infos )){ ?>
       	<?php foreach ($applied_infos as $job) { ?>

       	<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="<?php echo $job['view'];?>"><img class="img-responsive" src="<?php echo $job['banner'];?>" alt="p1" title="p1"/></a><div class="buttons">
							<div class="open-down">
								<button type="button" class="rotate1">
									<i class="fa fa-link" aria-hidden="true"></i>
								</button>
								<a href="<?php echo $job['quick'];?>">
								<button type="button" class="rotate1">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button></a>
							</div>
						</div>		
					</div>		
					<div class="caption">
						<h4><a href="javascript:void(0)"><?php echo $job['title'];?></a></h4>
						<ul class="list-inline">
							<li><a href="javascript:void(0)"><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $job['type'];?></a></li>
							<li><a href="javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $job['zone'];?></a></li>
						</ul>
						<p><?php echo $job['description'];?> [...]</p>
					</div>
					<a href="<?php echo $job['view'];?>"><button type="button" class="btn btn-info">VIEW MORE</button></a>
					
				</div>
			</div>
       		
       <?php	} } ?>
		   

		</div>
		</div>
    </div>
</div>

<?php echo $footer; ?>
