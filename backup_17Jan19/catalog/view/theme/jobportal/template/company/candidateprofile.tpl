<?php echo $header; ?>
<div class="top-breadcrumb">
	<div class="container">
		<h1><?php echo $heading_title; ?></h1>
	
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
		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal candidate-single">
			<div class="form-group">
				<div class="col-sm-5">
					<img src="<?php echo $thumb?>" alt="my_profile" title="my_profile" class="img-responsive">
				</div>
				<div class="col-sm-7">
					<div class="matter">
						<label><?php echo $entry_fullname;?></label>
						<span><?php echo $fullname;?></span>
					</div>	
					<div class="matter">
						<label><?php echo $entry_gender;?></label>
						<span><?php echo $gender; ?></span>
					</div>	
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_birth_date; ?></label>
						<span><?php echo $date_of_birth;?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_country; ?></label>
						<span><?php echo $country; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_zone; ?></label>
						<span><?php echo $zone; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_city; ?></label>
						<span><?php echo $city; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_address; ?></label>
						<span><?php echo $address; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_pincode; ?></label>
						<span><?php echo $pincode; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_mobile; ?></label>
						<span><?php echo $mobile_phone; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_home_phone;?></label>
						<span><?php echo $home_phone; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_profissional; ?></label>
						<span><?php echo $profissional; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_experience; ?></label>
						<span><?php echo $experience; ?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="matter">
						<label><?php echo $entry_education; ?></label>
						<table class="table">
							<tr>
								<td><b><?php echo $entry_degree ?></b></td>
								<td><b><?php echo $entry_collage; ?></b></td>
								<td><b><?php echo $entry_passed; ?></b></td>
								<td><b><?php echo $entry_percentage ?></b></td>
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
						<label><?php echo $entry_my_information; ?></label>
							<table class="table">
							<tr>
								<td><?php echo $entry_interest; ?></td>
								<td class="bor"><?php echo $interest; ?></td>
							</tr>
							<tr>
								<td><?php echo $entry_career; ?></td>
								<td class="bor"><?php echo $career; ?></td>
							</tr>
							<tr>
								<td><?php echo $entry_achievement; ?></td>
								<td class="bor"><?php echo $achievement; ?></td>
							</tr>	
						</table>
					</div>
				</div>
			</div>
			<div class="button">
				<div class="pull-left">
					<button type="button" class="btn btn-primary btnus" data-toggle="modal" data-target="#contactmodel"><?php echo $button_contact; ?></button>
				</div>
				<div class="pull-right">
				   <a href="<?php echo $resumecv;?>" target="_blank" class="btn btn-primary btnus" download><?php echo $button_download; ?></a>


				</div>
			</div>
      </form>
      <br/>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>


<div class="modal fade" id="contactmodel" tabindex="-1" role="dialog" aria-labelledby="contactmodel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form method="post" action="">	
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $text_message; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="candidateemail">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><?php echo $text_company; ?></label>
            <input type="text" class="form-control" id="recipient-name" name="name">
             <input type="hidden" name="employ_id" value="<?php echo $employid?>">
             <div class="nameerror text-danger"></div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><?php echo $text_contact; ?></label>
            <input type="text" class="form-control" id="recipient-name" name="phone">
            <div class="phoneerror text-danger"></div>
           </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><?php echo $text_email; ?></label>
            <input type="text" class="form-control" id="recipient-name" name="companyemail">
            <div class="emailerror text-danger"></div>
          </div>
          <div class="form-group">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><?php echo $text_message; ?></label>
            <textarea class="form-control" id="message-text" name="message"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">

        <button type="button"  id="buttonemail" class="btn btn-primary"><?php echo $text_sendmsg; ?></button>
      </div>
    </div>
 </div>
  </div>
</div>


<script>
	$('#buttonemail').click(function(){
		$.ajax({
			url: 'index.php?route=company/candidateprofile/serviceviewemail',
			type: 'post',
			data: $('.candidateemail input,.candidateemail hidden,.candidateemail textarea'),
			dataType: 'json',
			beforeSend: function() {
			},
			success: function(json) {
			if(json['error']){

				if(json['error']['name'])
				{
				 $('.nameerror').html(json['error']['name']);
				}
				if(json['error']['phone'])
				{
			 	 $('.phoneerror').html(json['error']['phone']);
				}
				if(json['error']['companyemail'])
				{
				  $('.emailerror').html(json['error']['companyemail']);
				}
			}
			if (json['success']) {
				var text_success_msg = '<div class="p-3 mb-2 text-success text-white"></div>';
				$('.candidateemail').html(text_success_msg+json['success']);
					setTimeout(function(e){ $('.close').trigger('click');location.reload();},1000);
			}
		}
	});
	});

</script>
<?php echo $footer; ?>
