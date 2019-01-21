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
    <?php if ($error_install) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_install; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div class="jobportal-dashboard">
		<h1> <?php echo $heading_dashboard;?></h1>
		<div class="clearfix"></div>
		<div class="dashboard-box row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="dashboard-boxinner box-bg1">
					<h2> <?php echo $heading_job;?></h2>
					<h3>
					<?php 
					if(isset($employ_total))
							{
								echo $employ_total;
							} else {
								echo 0;	
							} 
					?>
					</h3> 
				</div>	
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="dashboard-boxinner box-bg2">
					<h2> <?php echo $heading_available;?></h2>
					<h3><?php 
					if(isset($list_total))
							{
								echo $list_total;
							} else {
								echo 0;	
							} 
					?></h3>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="dashboard-boxinner box-bg3">
					<h2><?php echo $heading_resume;?></h2>
					<h3><?php 
					if(isset($company_total))
							{
								echo $company_total;
							} else {
								echo 0;	
							} 
					?></h3>
				</div>
			</div>	
		</div>	
	</div>
    <?php foreach ($rows as $row) { ?>
    <div class="row">
      <?php foreach ($row as $dashboard_1) { ?>
      <?php $class = 'col-lg-' . $dashboard_1['width'] . ' col-md-3 col-sm-6'; ?>
      <?php foreach ($row as $dashboard_2) { ?>
      <?php if ($dashboard_2['width'] > 3) { ?>
      <?php $class = 'col-lg-' . $dashboard_1['width'] . ' col-md-12 col-sm-12'; ?>
      <?php } ?>
      <?php } ?>
	  
	  	 
      <div class="<?php echo $class; ?>"><?php echo $dashboard_1['output']; ?></div>

	  
      <?php } ?>
    </div>
    <?php } ?>
  </div>
</div>
<?php echo $footer; ?>