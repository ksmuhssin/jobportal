<div class="blogssearch">
	<h2><?php echo $text_search; ?></h2>
	<div id="blogsearch" class="input-group">
		<input type="text" name="search" value="<?php echo $search?>" placeholder="<?php echo $text_search; ?>" class="form-control" />
		<span class="input-group-btn">
			<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
		</span>
	</div>
</div>

<div class="postright">
	<ul class="nav nav-tabs">
		<?php if($recentpoststatus) {?>
		<li class="active"><a href="#tab-recentpost" data-toggle="tab"><?php echo $recentposttitle; ?></a></li>
		<?php } ?>
		<?php if($popularstatus) {?>
		<li><a href="#tab-popular" data-toggle="tab"><?php echo $populartitle; ?></a></li>
		<?php } ?>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active in" id="tab-recentpost">
			<?php foreach ($recentposts as $recentpost) { ?>
			<div class="postbox">
				<div class="userpic"><a href="<?php echo $recentpost['href']; ?>"><img src="<?php echo $recentpost['thumb']; ?>" alt="<?php echo $recentpost['name']; ?>" title="<?php echo $recentpost['name']; ?>" class="img-responsive" /></a></div>
				<div class="comment">
					<h5><?php echo $recentpost['name']; ?></h5>
					<div class="pull-right"><a data-toggle="tooltip" title="<?php echo $text_readmore; ?>" href="<?php echo $recentpost['href']; ?>"><i class="fa fa-plus-circle"></i></a>
					</div>
					<span><i><?php echo $recentpost['date_added']; ?></i></span><br/>
					
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="tab-pane" id="tab-popular">
			<?php foreach ($popularpost as $popular) { ?>
			<div class="postbox">
				<div class="userpic"><a href="<?php echo $popular['href']; ?>"><img src="<?php echo $popular['thumb']; ?>" alt="<?php echo $popular['name']; ?>" title="<?php echo $popular['name']; ?>" class="img-responsive" /></a></div>
				<div class="comment">
					<h5><?php echo $popular['name']; ?></h5>
					<div class="pull-right"><a data-toggle="tooltip" title="<?php echo $text_readmore; ?>" href="<?php echo $popular['href']; ?>"><i class="fa fa-plus-circle"></i></a>
						</div>
					<span><i><?php echo $popular['date_added']; ?></i></span><br/>
					
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
	<div class="commentpage hide">
		<?php if($commentstatus) {?>
		<h2><?php echo $commenttitle; ?></h2>
		<?php } ?>
		<div id="comment">
			<?php foreach ($comments as $commen){ ?>
			<div class="commentbox">
			<div class="comment">
			<div class="name"><?php echo $commen['customer_name']; ?></div> 
			
			<div class="commnettext"><?php echo $commen['comment']; ?>
			<div class="pull-right"><a data-toggle="tooltip" title="<?php echo $text_readmore; ?>" href="<?php echo $commen['href']; ?>"><i class="fa fa-plus-circle"></i></a>
			</div>
			</div>
			  <br class="clear"/>	
			</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="tags">
		<h2><?php echo $text_tags; ?></h2>
			<ul class="list-inline">
				
				<li>
				
				<?php foreach($tags as $tag){?>
				<?php if(!empty($tag['tag'])){?>
				<a href="<?php echo $tag['href']?>"><?php echo $tag['tag']?></a>
				
				<?php } else{ ?>
				<a style="display:none"></a>
				<?php } } ?>
				</li>
				
				
				
			</ul>
	</div>

<script type="text/javascript"><!--
jQuery("document").ready(function($){
	var nav = $('.postright');
	$(window).scroll(function () {
		if ($(this).scrollTop() > 750) {
			nav.addClass("fnav");		
		} else {
			nav.removeClass("fnav");
		}
	});

});
--></script>
<script>
/* Search */
	$('#blogsearch input[name=\'search\']').parent().find('button').on('click', function() {
		var url = $('base').attr('href') + 'index.php?route=tmdblog/allblogcategory';

		var value = $('#blogsearch input[name=\'search\']').val();

		if (value) {
			url += '&search=' + encodeURIComponent(value);
		}

		location = url;
	});

	$('#blogsearch input[name=\'search\']').on('keydown', function(e) {
		if (e.keyCode == 13) {
			$('#blog-search input[name=\'search\']').parent().find('button').trigger('click');
		}
	});
</script>
