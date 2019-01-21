<?php echo $header; ?>
<div class="top-breadcrumb">
  <div class="container">
    <h1><?php echo $heading_title; ?></h1>
   </div>
</div>
<div class="container">
<!--static code start-->
	<div class="col-sm-12 sort">
		<div class="col-md-2 col-xs-6">
			<div class="form-group input-group input-group-sm">
				<label class="input-group-addon" for="input-sort"><?php echo $text_sort; ?></label>
				<select name="filter_status" id="input-status" class="form-control filtershow">
                 <option value=""><?php echo $text_select?></option>
     	    	  <option value="1" <?php if ($filter_status == 1) { echo 'selected'; } ?>><?php echo $text_parttime; ?>
     	    	  </option>
     	    	  <option value="2" <?php if ($filter_status == 2) { echo 'selected'; } ?>><?php echo $text_fulltime; ?>
     	    	  </option>
                </select>
			</div>
		</div>
		<button type="button" id="button-filter" class="btn btn-primary pull-right hide"><i class="fa fa-filter"></i> sdfsdf</button>
		
		<div class="col-md-2 col-sm-2 col-xs-12">
			<label class="control-label" >Category:</label>
			<select name="job_filter"id="input-limit" class="form-control selectpicker categoryid" >
					<option value=""><?php echo $text_select?></option>
					<?php foreach($categories as $category){ ?>
					<?php if($category_id == $category['category_id']){ ?>
					<option value="<?php echo $category['category_id'];?>" selected="selected"><?php echo $category['name']; ?></option>
					<?php } else{ ?>
					<option value="<?php echo $category['category_id'];?>"><?php echo $category['name']; ?></option>
					<?php } }?>
				</select>
		</div>
		<div class="keyword col-md-8 col-sm-8 col-xs-12">
			<label class="control-label">Keywords:</label>
			<ul class="list-inline" id="job_filter">
			 <?php foreach($categorieslists as $category){ ?>
			 <li  class="categoryid2"> 
			 	<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
	 
			 </li>
			 <?php } ?>
			</ul>
		</div>
    </div>
    <!--static code end-->

  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> allcandidate"><?php echo $content_top; ?>
		<div class="row">
          
           <?php if(isset($employinfos)){ ?>
            <?php foreach ($employinfos as $employinfo) { ?>
			<div class="col-sm-6 col-md-4 col-xs-12">
				<div class="product-thumb">
					<div class="image">
						<a href="<?php echo $employinfo['href']?>">
							<img class="img-responsive" src="<?php echo $employinfo['image']?>" alt="img1" title="img1"/>
						</a>	
						<div class="buttons">
							<div class="open-down">
								<a href="<?php echo $employinfo['href']?>">
									<button type="button" class="rotate1">
									<i class="fa fa-link" aria-hidden="true"></i>
								</button>
							</a>
								<a href="<?php echo $employinfo['quickemploy']?>" data-toggle="modal" class="quicklink" data-target="#quick_link">
									<button type="button" class="rotate1">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</a>
							</div>
						</div>		
					</div>		
					<div class="caption">
						<h4><a href=""><?php echo $employinfo['fullname']?></a>
						<button type="button" class="rotate1">
							<i class="fa fa-link" aria-hidden="true"></i>
						</button>
						</h4>
						<ul class="list-inline">
							<li>
								<a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> <?php echo $employinfo['profissional']?></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $employinfo['address']?></a>
							</li>
						</ul>
						<p><?php $data=$employinfo['description'];echo html_entity_decode($data);?> [...]</p>
					</div>
					 <a href="<?php echo $employinfo['href']?>"><button type="button" class="btn btn-info">VIEW MORE</button></a>
				</div>
			</div>
          <?php } ?>
          <?php } else { ?>
				<p>
				<img  class="img-responsive" src="catalog/view/theme/jobportal/image/not-found.jpg" alt="img" title="not found" >
				<br/>
					<?php echo $text_no_results; ?></p>
				
				<?php } ?>
				<div class="clearfix">
					
				</div>
					
			</div>
            <div class="row">
				<div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
				<div class="col-sm-12 text-right"><?php echo $results; ?></div>
			</div>
		</div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<script type="text/javascript"><!--
   $('#button-filter').on('click', function() {
	var url = 'index.php?route=employ/listemploy';

	var job_filter = $('select[name=\'job_filter\']').val();
	if (job_filter) {
		url += '&job_filter=' + encodeURIComponent(job_filter);
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
