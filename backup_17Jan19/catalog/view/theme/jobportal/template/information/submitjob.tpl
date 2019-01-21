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
<div class="container submit-job-form">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	<!-- submit-form start here -->
		<div class="submit-form">
			<div class="border"></div>
			<div class="border1"></div>
			<form class="form-horizontal" method="post" action="#">
				<fieldset>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Your Email</label>
							<input class="form-control" id="input-email" placeholder="you@yourdomain.com *" value="" name="email" required="" type="text">
						</div>
						<div class="col-sm-6">
							<label>Job Title</label>
							<input class="form-control" placeholder="" id="input-jobtitle" value="" name="jobtitle" required="" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Location (optional)</label>
							<input class="form-control" id="input-location" placeholder="e.g. Canada *" value="" name="location" required="" type="text">
						</div>
						<div class="col-sm-6">
							<label>Job Type</label>
							<select class="jobtype" class="form-control selectpicker">
							<option selected="" value="0">Full Time</option>
							<option value="1">Part Time</option>
							<option value="2">Full Time</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Job Category</label>
							<input class="form-control" id="input-job" placeholder="e.g. PHP, Web designer, Manager *" value="" name="job category" required="" type="text">
						</div>
						<div class="col-sm-6">
							<label>Salary</label>
							<input class="form-control" placeholder=" e.g. $20,000 *" id="input-salary" value="" name="salary" required="" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Description</label>
							<textarea class="form-control" id="input-enquiry" rows="10" name="enquiry" placeholder="Your message *" required=""></textarea>
						</div>
						<div class="col-sm-6">
							<label>Job banner image</label>
							<div class="browse">
								<input type="file" name="file" id="file" class="inputfile" />
								<label for="file">Choose a file</label>
							</div>
							<span>Max file size 2MB. Allowed file format jpg, gif, png.</span>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Application Email/URL</label>
							<input class="form-control" id="input-url" placeholder="Enter an email address or website URL *" value="" name="email" required="" type="text">
						</div>
					</div>
					<h5>Compnay Details</h5>
					<div class="form-group">
						<div class="col-sm-4">
							<label>Company name</label>
							<input class="form-control" placeholder=" Enter the company name *" id="input-company" value="" name="company name" required="" type="text">
						</div>
						<div class="col-sm-4">
							<label>Website(optional)</label>
							<input class="form-control" placeholder=" http:// *" id="input-website" value="" name="website" required="" type="text">
						</div>
						<div class="col-sm-4">
							<label>Tagline (optional)</label>
							<input class="form-control" placeholder="Briefly describe your company *" id="input-tagline" value="" name="tagline" required="" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Description</label>
							<textarea class="form-control" id="input-desc" rows="10" name="enquiry" placeholder="Your message *" required=""></textarea>
						</div>
						<div class="col-sm-6">
							<label>Social Profiles (optional)</label>
							<div class="fb">
								<i class="fa fa-facebook" aria-hidden="true"></i>
								<input class="form-control pull-right" placeholder="Enter page URL *" id="input-tagline1" value="" name="tagline" required="" type="text">
							</div>	
							<div class="twitter">
								<i class="fa fa-twitter" aria-hidden="true"></i>
								<input class="form-control pull-right" placeholder="@ yourcompany *" id="input-tagline2" value="" name="tagline" required="" type="text">
							</div>	
							<div class="google">
								<i class="fa fa-google-plus" aria-hidden="true"></i>
								<input class="form-control pull-right" placeholder="Enter page URL *" id="input-tagline3" value="" name="tagline" required="" type="text">
							</div>	
						</div>
					</div>
					<div class="buttons">
						<button type="submit" value="Submit" class="btn btn-primary btnus">SUBMIT A JOB</button>
					</div>
				</fieldset>
			</form>
		</div>
	<!-- submit-form end here -->
     <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
