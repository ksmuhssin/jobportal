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
<div class="job">
<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="jobsearch">
			<div class="off"></div>
			<h1><?php echo $text_findjob; ?></h1>
			<div class="col-md-4 col-sm-4 col-xs-12 paddleft">
				<div class="input-group">
					<input name="filter_search" class="form-control" value="<?php echo $filter_search?>" placeholder="Keyword" type="text">
				</div>
			</div>	
			<div class="col-md-8 col-sm-8 col-xs-12 padd0">
				<div class="col-md-5 col-sm-5 col-xs-12 paddleft">
					<select name="job_filter" id="input-limit" class="form-control selectpicker" >
					<option value=""><?php echo $text_select?></option>
					<?php foreach($categories as $category){ ?>
					<?php if($job_filter == $category['category_id']){ ?>
					<option value="<?php echo $category['category_id'];?>" selected="selected"><?php echo $category['name']; ?></option>
					<?php } else{ ?>
					<option value="<?php echo $category['category_id'];?>"><?php echo $category['name']; ?></option>
					<?php } }?>
				</select>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-12 paddleft">
					<div class="input-group">
					<input name="filter_location" class="form-control" value="<?php echo $filter_location?>" placeholder="Job Location" type="text">
				</div>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 padd0">
					<button type="button" class="btnsrch"  id="buttonjob-filter"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="match">
			<p><?php echo $jobtotalresult; ?> Matching job found. </p>
		</div>
	</div>	
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	<!-- code start here -->
	<div class="row">
		<?php if(!empty($jobs)) { ?>
		<?php foreach ($jobs as $job) { ?>
		<div class="product-layout product-grid col-md-3 col-sm-3 col-xs-12">
			<div class="product-thumb">
				<div class="image">
					<a href="<?php echo $job['href']; ?>"><img src="<?php echo $job['banner']; ?>" alt="<?php echo $job['banner']; ?>" title="<?php echo $job['banner']; ?>" class="img-responsive" /></a>
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
				<div class="caption" style="text-align:left;">
					<h4><a href="<?php echo $job['href']; ?>"><?php echo $job['title'] ;?></a></h4>
					<ul class="list-inline">
						<li>
							<a><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $job['type']; ?></a>
						</li>
						<li>
							<a><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $job['zone']; ?></a>
						</li>
						<li>
							<a><i class="fa fa-money" aria-hidden="true"></i> <?php echo $job['salary']; ?></a>
						</li>
						<li>
							<a><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $job['date_added']; ?></a>
						</li>
					</ul>
					<p><?php echo $job['description']; ?></p>
					<div class="in">
						<a href="<?php echo $job['view']; ?>"><button type="button" class="btn btn-info"><?php echo $button_view_more; ?></button></a>
						<a href="<?php echo $job['apply']; ?>"><button type="button" class="btn btn-info"><?php echo $button_apply_now; ?></button></a>
					</div>
				</div>
				<div class="out">
					<a href="<?php echo $job['view']; ?>"><button type="button" class="btn btn-info"><?php echo $button_view_more; ?></button></a>
					<a href="<?php echo $job['apply']; ?>"><button type="button" class="btn btn-info"><?php echo $button_apply_now; ?></button></a>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php } else { ?>
				<tr>
					<td class="text-center" colspan="4">
					<img  class="img-responsive" src="catalog/view/theme/jobportal/image/not-found.jpg" alt="img" title="not found" >
				<br/>
				<?php echo $text_no_results; ?>
					</td>
				</tr>
				<?php } ?>
				<div class="clearfix">
					
				</div>
					<div class="row">
				<div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
				<div class="col-sm-12 text-right"><?php echo $results; ?></div>
			</div>
	</div>
	<!-- featured end here -->
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</div>

<script type="text/javascript"><!--
   $('#buttonjob-filter').on('click', function() {
	var url = 'index.php?route=job/searchjob';

	var job_filter = $('select[name=\'job_filter\']').val();
	if (job_filter) {
		url += '&job_filter=' + encodeURIComponent(job_filter);
	}

	var filter_search = $('input[name=\'filter_search\']').val();
	if (filter_search) {
		url += '&filter_search=' + encodeURIComponent(filter_search);
	}
	var filter_location = $('input[name=\'filter_location\']').val();
	if (filter_location) {
		url += '&filter_location=' + encodeURIComponent(filter_location);
	}

	location = url;
});
$(document).on('click','.quicklink',function(e) {
	$('#quick_link .modal-content').html('<div class="loader-if centered"></div>');
   $('#quick_link').load($(this).attr('href'));
  
});
//--></script>

<?php echo $footer; ?>
