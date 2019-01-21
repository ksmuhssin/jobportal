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
		<div class="membership-main">
			<div class="membership-logo">
				<img src="catalog/view/theme/jobportal/image/premium-member.png" alt="" border="0">
			</div>
			<div class="choose-membership">
				<h2><?php echo $text_company_detail;?> </h2>	
			</div>	
		<ul class="nav nav-tabs">
			<li class="active"><a href="#info-tab" data-toggle="tab">Listing Membership <i class="fa"></i></a></li>
			<li><a href="#address-tab" data-toggle="tab">Premimum Membership <i class="fa"></i></a></li>
		</ul>
			<div class="form-area">
				<div class="tab-content">
					<div class="tab-pane active" id="info-tab">
					  <!-- FORM HERE -->
						<form role="form" class="registration-form" id="addlogs" action="javascript:void(0);">
								<fieldset>
									<div class="form-top">
										<div class="form-top-left">
											<h3>Choose your Listing Option</h3>
											
										</div>
									</div>
									<div class="form-bottom">
										<div class="row">
											<div class="col-md-12">
												<div class="funkyradio">
													<div class="funkyradio-primary">
														<input type="radio" name="radio" id="radio2" checked/>
														<label for="radio2"> $5 Single List  Posting </label>
													</div>
													<div class="funkyradio-success">
														<input type="radio" name="radio" id="radio3" />
														<label for="radio3"> $25 Single List  Posting</label>
													</div>
													<div class="funkyradio-danger">
														<input type="radio" name="radio" id="radio4" />
														<label for="radio4">$50 Single List  Posting</label>
													</div>
													<div class="funkyradio-warning">
														<input type="radio" name="radio" id="radio5" />
														<label for="radio5">$100 Single List  Posting</label>
													</div>
												</div>
											</div>
										</div>
										<button type="button" class="btn pull-right btn-next">Next</button>
										<div class="clearfix"></div>
									</div>
								</fieldset>
								<fieldset>
									<div class="form-top">
										<div class="form-top-left">
											<h3> Payment Details</h3>
										</div>
									</div>
									<div class="form-bottom">
									<div class="panel panel-default">
									<ul class="list-inline">
										<li>
										<img src="catalog/view/theme/jobportal/image/eway_creditcard_master.png" alt="" border="">
										</li>
										<li>
										<img src="catalog/view/theme/jobportal/image/eway_creditcard_visa.png" alt="" border="">
										</li>
										<li>
										<img src="catalog/view/theme/jobportal/image/eway_creditcard_amex.png" alt="" border="">
										</li>
										<li>
										<img src="catalog/view/theme/jobportal/image/eway_vme.png" alt="" border="">
										</li>
									</ul>
										<div class="panel-body">
											<form role="form">
											<div class="form-group">
												<label for="cardNumber">
													CARD NUMBER</label>
												<div class="input-group">
													<input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="Valid Card Number"
														required autofocus />
													<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-7 col-md-7">
													<div class="form-group">
														<label for="expityMonth">
															EXPIRY DATE
														</label><br/>
														<div class="col-xs-6 col-sm-6 pl-ziro">
															<input type="text" class="form-control" name="expiry_month" id="expiryMonth" placeholder="MM" required />
														</div>
														<div class="col-xs-6 col-sm-6 pl-ziro">
															<input type="text" class="form-control" name="expiry_year" id="expiryYear" placeholder="YY" required />
														</div>
													</div>
												</div>
												<div class="col-xs-5 col-md-5 pull-right">
													<div class="form-group">
														<label for="cvCode">
															CV CODE</label>
														<input type="password" class="form-control" name="cv_code" id="cvCode" placeholder="CV" required />
													</div>
												</div>
											</div>
											</form>
										</div>
									</div>
    									<button type="button" class="btn btn-previous">Previous</button>
										<button type="submit" class="btn pull-right logs">Submit</button>
										<div class="clearfix"></div>
									</div>
								</fieldset>
							</form>
					  
					  <!-- FORM HERE -->
					</div>
					<div class="tab-pane" id="address-tab">
						<!---FORM HERE-->
						<form role="form" class="registration-form" id="addmember" action="javascript:void(0);">
								<fieldset>
									<div class="form-top">
										<div class="form-top-left">
											<h3>Choose your Listing Option</h3>
											
										</div>
									</div>
									<div class="form-bottom">
										<div class="row">
											<div class="col-md-12">
												<div class="funkyradio">
													<div class="funkyradio-primary">
														<input type="radio" name="radio" id="radio22" checked/>
														<label for="radio22"> $50  Brownze Membership (1 Month)</label>
													</div>
													<div class="funkyradio-success">
														<input type="radio" name="radio" id="radio33" />
														<label for="radio33"> $100  Silver Membership (3 Month)</label>
													</div>
													<div class="funkyradio-danger">
														<input type="radio" name="radio" id="radio44" />
														<label for="radio44">$150  Gold Membership (12 Month)</label>
													</div>
													<div class="funkyradio-warning">
														<input type="radio" name="radio" id="radio55" />
														<label for="radio55">$500  Dimond Membership (Life Time)</label>
													</div>
												</div>
											</div>
										</div>
										<button type="button" class="btn pull-right btn-next">Next</button>
										<div class="clearfix"></div>
									</div>
								</fieldset>
								<fieldset>
									<div class="form-top">
										<div class="form-top-left">
											<h3> Payment Details</h3>
										</div>
									</div>
									<div class="form-bottom">
									<div class="panel panel-default">
									<ul class="list-inline">
									<li>
									<img src="catalog/view/theme/jobportal/image/eway_creditcard_master.png" alt="" border="">
									</li>
									<li>
									<img src="catalog/view/theme/jobportal/image/eway_creditcard_visa.png" alt="" border="">
									</li>
									<li>
									<img src="catalog/view/theme/jobportal/image/eway_creditcard_amex.png" alt="" border="">
									</li>
									<li>
									<img src="catalog/view/theme/jobportal/image/eway_vme.png" alt="" border="">
									</li>
										
									</ul>
										<div class="panel-body">
											<div class="form-group">
												<label for="cardNumber">
													CARD NUMBER</label>
												<div class="input-group">
													<input type="text" class="form-control" name="card_number" id="cardNumber" placeholder="Valid Card Number"
														required autofocus />
													<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-7 col-md-7">
													<div class="form-group">
														<label for="expityMonth">
															EXPIRY DATE
														</label><br/>
														<div class="col-xs-6 col-sm-6 pl-ziro">
															<input type="text" class="form-control" name="expiry_month" id="expityMonth" placeholder="MM" required />
														</div>
														<div class="col-xs-6 col-sm-6 pl-ziro">
															<input type="text" class="form-control" name="expiry_year" id="expityYear" placeholder="YY" required />
														</div>
													</div>
												</div>
												<div class="col-xs-5 col-md-5 pull-right">
													<div class="form-group">
														<label for="cvCode">
															CV CODE
														</label>
														<input type="password" class="form-control" name="cv_code" id="cv_code" placeholder="CV" required />
													</div>
												</div>
											</div>
										
										</div>
									</div>
    									<button type="button" class="btn btn-previous">Previous</button>
										<button type="submit" class="btn pull-right member">Submit</button>
										<div class="clearfix"></div>
									</div>
								</fieldset>
						</form>	
					</div>
				</div>
			</div>
			
		</div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script>
	$(document).ready(function () {
    $('.registration-form fieldset:first-child').fadeIn('slow');

    $('.registration-form input[type="text"]').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // next step
    $('.registration-form .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;

        parent_fieldset.find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "") {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });
        }

    });

    // previous step
    $('.registration-form .btn-previous').on('click', function () {
        $(this).parents('fieldset').fadeOut(400, function () {
            $(this).prev().fadeIn();
        });
    });

    // submit
    $('.registration-form').on('submit', function (e) {

        $(this).find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });

    });

   
});

</script>
<!---Membership--->
<script>

$('.logs').click(function(){
	$.ajax({
	url: 'index.php?route=company/membership/creatlog',
	data: $('#addlogs input'),
	type:'post',
	dataType:'json',
		beforeSend: function() {
	},
	success: function(json) {
			
	}
});
});

</script>
<!---Membership--->
<!---Premimum Membership--->
<script>

$('.member').click(function(){
	$.ajax({
	url: 'index.php?route=company/membership/insert',
	data: $('#addmember input'),
	type:'post',
	dataType:'json',
		beforeSend: function() {
	},
	success: function(json) {
			
	}
});
});

</script>
<!---Premimum Membership--->
<?php echo $footer; ?>
