<div id="tmdcategorysearch">
	<h2><?php echo $heading_title; ?></h2>
	<div class="list-group">
		<?php foreach ($categories as $category) { ?>
			<a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $category['name']; ?></a>
			<?php if($category['children']) {
				foreach($category['children'] as $child){ ?>
					<a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
			<?php }} ?>
				
		<?php } ?>
	</div>
</div>

