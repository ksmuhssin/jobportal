<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul><?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
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
    <div id="content" >
		
       <h1><?php echo $heading_title; ?></h1>
		 <form  method="post" enctype="multipart/form-data" id="form-information">
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
					<td class="text-left"><?php if ($sort == 'title') { ?>
					<a href="<?php echo $sort_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_email; ?></a>
					<?php } else { ?>
					<a href="<?php echo $sort_email; ?>"><?php echo $column_email; ?></a>
					<?php } ?>
					</td>
					<td class="text-left"><?php if ($sort == 'message') { ?>
					<a href="<?php echo $sort_message; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_message; ?></a>
					<?php } else { ?>
					<a href="<?php echo $sort_message	; ?>"><?php echo $column_message; ?></a>
					<?php } ?>
					</td>
				</tr>
				</thead>
				<?php if ($messages) { ?>
					<?php foreach ($messages as $message) { ?>
					<tr>
						<td class="text-left"><?php echo $message['email']; ?></td>
						<td class="text-left"><?php echo $message['message']; ?></td>
					</tr>
					<?php } ?> 
					<?php } else { ?>
				<tr>
				<td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
				</tr>
				<?php } ?>
			</table>
			</div>
    	</form>
		<div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
		<div class="col-sm-12 text-right"><?php echo $results; ?></div>
		</div>
    </div>
</div>

<?php echo $footer; ?>