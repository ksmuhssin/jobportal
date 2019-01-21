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
<div class="container catepage">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
		
		<div class="col-md-12 col-sm-12 col-xs-12 sort">
		<div class="row">
			<div class="col-md-2 col-xs-12">
			<div class="form-group input-group input-group-sm">
				<label class="input-group-addon" for="input-status"><?php echo $text_sort; ?></label>
				 <select name="filter_status" id="input-status" class="form-control filtershow">
                 <option value=""><?php echo $text_select?></option>
     	    	  <option value="1" <?php if ($filter_status == 1) { echo 'selected'; } ?>><?php echo $text_parttime; ?>
     	    	  </option>
     	    	  <option value="2" <?php if ($filter_status == 2) { echo 'selected'; } ?>><?php echo $text_fulltime; ?>
     	    	  </option>
                </select>
			</div>
		</div>
			<button type="buttion" class="hide" id="button-filter"></button>
			
			<div class="category col-md-2 col-sm-2 col-xs-12">
				<label class="control-label" ><?php echo $entry_category; ?></label>
				<select  name="category_id" class="form-control selectpicker categoryid">
					<?php foreach ($categories as $category) { ?>
					<?php if($category_id == $category['category_id']){ ?>
					<option value="<?php echo $category['category_id'];?>" selected="selected"><?php echo $category['name']; ?></option>
					<?php } else{ ?>
					<option value="<?php echo $category['category_id'];?>"><?php echo $category['name']; ?></option>
					<?php } }?>
				</select>
			</div>
			
			
		
		</div>
	  </div>
	  
	  
	  
     <div class="row">
		<?php if(!empty($jobs_info)) { ?>
        <?php foreach ($jobs_info as $jobs) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
            <div class="image"><a href="<?php echo $jobs['view'];  ?>"><img src="<?php echo $jobs['banner']; ?>" alt="<?php echo $jobs['title']; ?>" title="<?php echo $jobs['title']; ?>" class="img-responsive" /></a></div>
            <div>
              <div class="caption">
                <h4><a href="<?php echo $jobs['view']; ?>"><?php echo $jobs['title']; ?></a></h4>
				<ul class="list-inline gridbox">
				
				</ul>
				<ul class="list-inline listbox">
					<li>
						<a><i class="fa fa-bookmark" aria-hidden="true"></i>  <?php echo $jobs['type']; ?></a>
					</li>
					<li>
						<a><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $jobs['location']; ?></a>
					</li>
					<li>
						<a><i class="fa fa-rupee" aria-hidden="true"></i> <?php echo $jobs['salary']; ?></a>
					</li>
					<li>
						<a><i class="fa fa-shield" aria-hidden="true"></i> <?php echo $jobs['experience']; ?></a>
					</li>
					<li>
						<a><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $jobs['date_added']; ?></a>
					</li>
				</ul>
                <p class="des"><?php echo $jobs['description']; ?></p>
              <div class="in">
			  <a href="<?php echo $jobs['view'];  ?>">
                <button  type="button" class="btn-info" ><?php echo $button_view_more; ?></button>
			  </a>
			  <a href="<?php echo $jobs['view'];  ?>">
				<button type="button" class="btn-info" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" ><?php echo $button_apply_now; ?></button></a>
              </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php } else { ?>
				<p><?php echo $text_no_results; ?></p>
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
<script type="text/javascript">
$('#button-filter').on('click', function() {
	
	var url = 'index.php?route=job/category';
	var category_id = $('select[name=\'category_id\']').val();
	if (category_id) {
		url += '&category_id=' + encodeURIComponent(category_id);
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

</script>

<?php echo $footer; ?>
