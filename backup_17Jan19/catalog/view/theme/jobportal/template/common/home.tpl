<?php echo $header; ?>
<?php echo $column_slider; ?>
<div class="featured">
	<div class="container">
		<?php echo $column_feature; ?>
	</div>
</div>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    </div>
  </div>
</div>
	<?php echo $column_testi; ?>
	<div class="container">
	<?php echo $column_blog; ?>
	</div>
		<?php /*<div class="latestcandidate">
			<div class="container">
				<?php echo $column_candi; ?>
			</div>
		</div>*/?>
	
    <div class="container">
  <div class="row">
	  <div class="col-sm-12">
    <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
