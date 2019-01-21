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
	<!--static code start-->
	<div class="col-sm-12 col-xs-12 sort">
		<div class="col-md-2 col-sm-6 hidden-xs list-view">
			<div class="btn-group btn-group-sm">
				<button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
				<button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
			  </div>
		</div>
		<button type="buttion" class="hide" id="button-filter"></button>
		<div class="col-md-2 col-xs-12">
			<div class="form-group input-group input-group-sm">
				<label class="input-group-addon" for="input-status"><?php echo $label_jobtype; ?></label>
				 <select name="filter_status" id="input-status" class="form-control filtershow">
                 <option value=""><?php echo $text_select?></option>
     	    	  <option value="1" <?php if ($filter_status == 1) { echo 'selected'; } ?>><?php echo $text_parttime; ?>
     	    	  </option>
     	    	  <option value="2" <?php if ($filter_status == 2) { echo 'selected'; } ?>><?php echo $text_fulltime; ?>
     	    	  </option>
                </select>
			</div>
		</div>
		<div class="col-md-2 col-xs-12">
			<div class="form-group input-group input-group-sm">
				<label class="input-group-addon" for="input-limit"><?php echo $label_jobcategory; ?></label>
				<select name="job_filter" id="input-limit" class="form-control selectpicker categoryid" >
					<option value=""><?php echo $text_select?></option>
					<?php foreach($categories as $category){ ?>
					<?php if($job_filter == $category['category_id']){ ?>
					<option value="<?php echo $category['category_id'];?>" selected="selected"><?php echo $category['name']; ?></option>
					<?php } else{ ?>
					<option value="<?php echo $category['category_id'];?>"><?php echo $category['name']; ?></option>
					<?php } }?>
				</select>
			</div>
		</div>
		<div class="keyword col-md-6 col-sm-6 col-xs-12">
			<label class="control-label"><?php echo $label_keyword; ?></label>
            <!--static-->
			<ul class="list-inline" id="job_filter">
			 <?php foreach($categorieslists as $category){ ?>
			 <li  class="categoryid2"> 
			 	<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
			 </li>
			 <?php } ?>
			</ul>
            <!--static-->
		</div>
    </div>
    <!--static code end-->
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	<!-- featured start here -->
	<div class="row">
		<?php if(!empty($jobs)) { ?>
		<?php foreach ($jobs as $job) { ?>
		<div class="product-layout product-list col-xs-12">
			<div class="product-thumb">
				<div class="image">
					<a href="<?php echo $job['href']; ?>"><img src="<?php echo $job['banner']; ?>" alt="<?php echo $job['banner']; ?>" title="<?php echo $job['banner']; ?>" class="img-responsive" /></a>
					<div class="buttons">
                        <!--static-->
						<div class="open-down">
							<a href="<?php echo $job['href']; ?>"><button type="button" class="rotate1">
								<i class="fa fa-link" aria-hidden="true"></i>
							</button></a>
							<a href="<?php echo $job['quick']; ?>" data-toggle="modal" class="quicklink" data-target="#quick_link"><button type="button" class="rotate1">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button></a>
                        <!--static-->
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
		
			<div class="clearfix">
			
			
				<img  class="img-responsive" src="catalog/view/theme/jobportal/image/not-found.jpg" alt="img" title="not found" >
				<br/>
					<p><?php echo $text_no_results; ?></p>
				<?php } ?>
			
				
				</div>
					
	</div>
        <div class="row">
				<div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
				<div class="col-sm-12 text-right"><?php echo $results; ?></div>
			</div>
	<!-- featured end here -->
	<?php echo $content_bottom; ?></div>
	<?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
   $('#button-filter').on('click', function() {
	var url = 'index.php?route=job/joblist';

	var job_filter = $('select[name=\'job_filter\']').val();
	if (job_filter) {
		url += '&job_filter=' + encodeURIComponent(job_filter);
	}
	
	var filter = $('button[name=\'filter\']').val();
	if (filter) {
		url += '&filter=' + encodeURIComponent(filter);
	}

	var filter_status = $('select[name=\'filter_status\']').val();
	if (filter_status) {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	location = url;
});

  $('.categoryid').on('change', function () {
		$('#button-filter').trigger('click');
});


   $('.filtershow').on('change', function () {
		$('#button-filter').trigger('click');
});



$(".categoryid2").click(function(){	
		$('#button-filter').trigger('click');
});
//--></script>
<?php echo $footer; ?>
