<br/><br/>

<?php foreach($comment_info as $info) {?>
	
	<div class="commentbox pull-left col-sm-12">
	<div class="col-sm-2 userbox">
		<img src="catalog/view/theme/jobportal/image/user_img.png"/>
		</div>
		
		<div class="comment col-sm-10">
			<span class="name"><?php echo $info['username']?></span> <span class="time"><?php echo $info['date_added'] ?></span>
		<p><?php echo $info['comment']; ?></p>
						<?php if($info['image']){?>
					<div class="image-responsice"> <img src="<?php echo $info['image']; ?>" title="<?php echo $info['comment']; ?>" alt="<?php echo $info['comment']; ?>" /> </div>
					<?php } ?>
		
			
		</div>
	</div>
	
	<?php    }?>

