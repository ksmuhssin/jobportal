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
		<div class="col-md-12 col-sm-12 col-xs-12 sort">
			<div class="category col-md-2 col-sm-2 col-xs-12">
               <label class="control-label" ><?php echo $text_showlimit; ?></label>
               <select name="filter_limit" id="input-limit" class="form-control selectpicker filtershow" >
				<option value=""><?php echo $text_select?></option>
				<?php foreach($shows  as $show){ ?>
				<?php if($filter_limit == $show['show_id']){ ?>
				<option value="<?php echo $show['show_id'];?>" selected="selected"><?php echo $show['value']; ?></option>
				<?php } else{ ?>
				<option value="<?php echo $show['show_id'];?>"><?php echo $show['value']; ?></option>
				<?php } }?>
               </select>
			</div>
			<button type="buttion" class="hide" id="button-filter"></button>
            <div class="category col-md-2 col-sm-2 col-xs-12">
			   <label class="control-label" ><?php echo $text_jobcategory; ?></label>
               <select name="category_id" id="input-category" class="form-control selectpicker categoryid" >
					<option value=""><?php echo $text_select?></option>
					<?php foreach($Categories as $category){ ?>
					<?php if($category_id == $category['category_id']){ ?>
					<option value="<?php echo $category['category_id'];?>" selected="selected"><?php echo $category['name']; ?></option>
					<?php } else{ ?>
					<option value="<?php echo $category['category_id'];?>"><?php echo $category['name']; ?></option>
					<?php } }?>
				</select>
			</div>
			<div class="keyword col-md-8 col-sm-8 col-xs-12">
                <!--static-->
				<label class="control-label"><?php echo $text_keywords; ?></label>
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
	  <?php if(isset($jobdetalis)){ ?>
        <?php foreach($jobdetalis as $jobdetali){ ?>
		<div class="col-md-4 col-sm-4 col-xs-12">
		  <div class="employe-box">
			 <div class="image">
			   <a href="<?php echo $jobdetali['href']?>">
                   <img class="img-responsive" src="<?php echo $jobdetali['thumb']?>"/>
                </a>
			 </div>		
			 <div class="pull-left">
				<p><?php echo $text_jobs; ?> <?php echo $jobdetali['jobtota'] ?></p>
			 </div>
             <!--static-->
			 <div class="pull-right">
				   <a href="<?php echo $jobdetali['href']?>"><button type="button" class="rotate1"><i class="fa fa-search" aria-hidden="true"></i></button> </a>
			 </div>
             <!--static-->
          </div>
		 </div>
		 <?php } ?>
		<?php } else { ?>
          <p><?php echo $text_empty; ?></p>
		<?php } ?>
      <div class="clearfix"></div>
      <div class="col-sm-12">
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
	var url = 'index.php?route=company/companylist';

	var category_id = $('select[name=\'category_id\']').val();
	if (category_id) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}

	var filter_limit = $('select[name=\'filter_limit\']').val();
	if (filter_limit) {
		url += '&filter_limit=' + encodeURIComponent(filter_limit);
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

<script>
$('input[name=\'filter_category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=company/companylist/autocomplete&filter_name=' +  encodeURIComponent(request),
			type: 'post',
			dataType: 'json',
			success: function(json) {
				json.unshift({
					category_id: 0,
					name:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_category\']').val(item['label']);
		$('input[name=\'category_id\']').val(item['value']);
	}
});
</script>
<?php echo $footer; ?>
