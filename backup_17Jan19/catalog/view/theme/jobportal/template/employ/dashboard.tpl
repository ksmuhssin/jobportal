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
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
		<div class="canditate-profile">
			<ul class="nav nav-tabs list-inline">
				<li class="active">
					<a href="<?php echo $edashboard; ?>"><?php echo $text_profile; ?></a>
				</li>
				<li class="">
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
		<div class="col-md-12">
			<form class="form-horizontal candidate-single" method="post">
				<fieldset>
					<div class="form-group">
						<div class="col-sm-4">
							<img src="<?php echo $thumb?>" alt="<?php echo $fullname; ?>" title="<?php echo $fullname; ?>" class="img-responsive">
					
						</div>
						<div class="col-sm-8">
							<div class="matter">
								<label><?php echo $dashboard_fullname; ?></label>
								<span><?php echo $fullname; ?></span>
							</div>	
							<div class="matter">
								<label><?php echo $dashboard_gender; ?>
								
								</label>
								<span><?php echo $gender; ?></span>
							</div>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_birth_date; ?>
								
								</label>
								<span><?php echo $date_of_birth; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_country; ?>
								
								</label>
								<span><?php echo $country; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_zone; ?>
								
								</label>
								<span><?php echo $zone; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_city; ?>
							
								</label>
								<span><?php echo $city; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_address; ?>
								
								</label>
								<span><?php echo $address; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_pincode; ?>
							
								</label>
								<span><?php echo $pincode; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_mobile; ?> 
								</label>
								<span><?php echo $mobile_phone; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_home_phone; ?>
							
								</label>
								<span><?php echo $home_phone; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_profissional; ?>
								
								</label>
								<span><?php echo $profissional; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_experience; ?>
								
								</label>
								<span><?php echo $experience; ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_education; ?>
								
								</label>
								<table class="table">
									<tr>
										<td><b><?php echo $dashboard_degree ?></b></td>
										<td><b><?php echo $dashboard_collage; ?></b></td>
										<td><b><?php echo $dashboard_passed; ?></b></td>
										<td><b><?php echo $dashboard_percentage ?></b></td>
									</tr>
									<?php if(isset($educations)){?>
	
									<?php foreach ($educations as $education) { ?>
									<tr>
										<td><?php echo $education['degree']; ?></td>
										<td><?php echo $education['collage']; ?></td>
										<td><?php echo $education['passed_year']; ?></td>
										<td><?php echo $education['percentage']; ?></td>
									</tr>
								<?php } } ?>
								</table>	
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="matter">
								<label><?php echo $dashboard_my_information; ?>
								
								</label>
								<span><?php echo $interest; ?></span>
								<span><?php echo $career; ?></span>
								<span><?php echo $achievement; ?></span>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="button">
				<div class="pull-right">
				 <?php if(!empty($resumecv)){ ?>	
				   <a href="<?php echo $resumecv;?>" target="_blank" class="btn btn-primary btnus" download><?php echo $button_download; ?></a>

                   <?php } ?>
				</div>
			</div>
			</form>
		</div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<?php echo $footer; ?>
