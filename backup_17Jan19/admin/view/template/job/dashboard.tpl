<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
		<div class="form-group required">
				<h1>Total joB: <?php echo $totaljob?></h1>
				<h1>Total PostjoB: <?php echo $totalpostjob?></h1>
				<h1>Total Orgttype: <?php echo $totalOrgttype?></h1>	
				<h1>Total Company: <?php echo $totalcompany?>	</h1>	
				<h1>Total Industry: <?php echo $totalindustry?></h1>		
				<h1>Total Jobtype: <?php echo $totaljobtype?>	</h1>		
				<h1>Today Date: </h1>
		</div>
  </div>
</div>
<?php echo $footer; ?>