<div class="modal-dialog modal-lg">
 <div class="modal-content">
  <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<div class="row">
<div class="col-sm-12">
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal candidate-single">
			<div class="form-group">
				<div class="col-sm-5">
					<img src="<?php echo $thumb?>" alt="my_profile" title="my_profile" class="img-responsive">
				</div>
				<div class="col-sm-7">
					<div class="matter">
						<label><?php echo $lable_fullname;?></label>
						<span><?php echo $fullname;?></span>
					</div>	
					<div class="matter">
						<label><?php echo $lable_gender;?></label>
						<span><?php echo $gender; ?></span>
					</div>	
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_birth_date; ?></label>
						<span><?php echo $date_of_birth;?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_country; ?></label>
						<span><?php echo $country; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_zone; ?></label>
						<span><?php echo $zone; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_city; ?></label>
						<span><?php echo $city; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_address; ?></label>
						<span><?php echo $address; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_pincode; ?></label>
						<span><?php echo $pincode; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_mobile; ?></label>
						<span><?php echo $mobile_phone; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_home_phone;?></label>
						<span><?php echo $home_phone; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_profissional; ?></label>
						<span><?php echo $profissional; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_experience; ?></label>
						<span><?php echo $experience; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_education; ?></label>
						<table class="table">
							<tr>
								<td><b><?php echo $lable_degree ?></b></td>
								<td><b><?php echo $lable_collage; ?></b></td>
								<td><b><?php echo $lable_passed; ?></b></td>
								<td><b><?php echo $lable_percentage ?></b></td>
							</tr>
							<?php if(isset($educations)){?>
							<?php foreach ($educations as $education) { ?>
							<tr>
								<td><?php echo $education['degree']; ?></td>
								<td><?php echo $education['collage']; ?></td>
								<td><?php echo $education['passed_year']; ?></td>
								<td><?php echo $education['percentage']; ?></td>
							</tr>
							<?php } ?>
								<?php } ?>
						</table>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $lable_my_information; ?></label>
							<table class="table">
							<tr>
								<td><?php echo $lable_interest; ?></td>
								<td class="bor"><?php echo $interest; ?></td>
							</tr>
							<tr>
								<td><?php echo $lable_career; ?></td>
								<td class="bor"><?php echo $career; ?></td>
							</tr>
							<tr>
								<td><?php echo $lable_achievement; ?></td>
								<td class="bor"><?php echo $achievement; ?></td>
							</tr>	
						</table>
					</div>
				</div>
			</div>
           <?php if(!empty($Logged)){ ?>
			<div class="button">
				<div class="pull-left">
					<button type="submit" value="Submit" class="btn btn-primary btnus"><?php echo $button_contact; ?></button>
				</div>
				<div class="pull-right">
				 <?php if(!empty($resumecv)){ ?>	
				   <a href="<?php echo $resumecv;?>" target="_blank" class="btn btn-primary btnus" download><?php echo $button_download; ?></a>

                   <?php } ?>
				</div>
			</div>
			<?php } ?>
      </form>
      <br/>
</div>
 </div>
</div>
</div>
</div>