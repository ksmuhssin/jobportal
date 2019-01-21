<?php if(!empty($megaheaders)) {?>
<div id="mega_menu">
	<?php if($menuexpend==0){ ?>
		<div class="">
	<?php } ?>
	<nav id="menu" class="">
		<?php if($menuexpend==1){ ?>
			<div class="container">
		<?php } ?>
		<div class="container-megamenu horizontal padd0">
			<div class="megaMenuToggle visible-xs">
				<span id="category"><?php echo $text_category; ?></span>
				<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			</div>
			<div class="megamenu-wrapper">
				<ul class="megamenu slide">
				<?php foreach($megaheaders as $megaheader) {
					if ($megaheader['sublink'] || !empty($megaheader['editor'])) { ?>				
						<li class="with-sub-menu hover">
						<p class="close-menu"></p>
						<p class="open-menu"></p>
						<?php if($megaheader['showicon']==1){?>
							<a href="<?php echo $megaheader['href']; ?>"> <i class="fa <?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i></a>
						<?php } else {?>
							<a class="menutitle" href="<?php echo $megaheader['href']; ?>" <?php if($megaheader['openew']) {?>target="_blank" <?php }?> class="clearfix">
							<?php if(!empty($megaheader['menu_label'])){ ?>
							
							<span class="toplable"><?php echo $megaheader['menu_label'];?></span>
							<?php } ?>
							<i class="fa <?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i> <?php echo $megaheader['title']; ?></a>
						<?php } ?>
						
						<?php if($megaheader['col']==1){?>
							<div class="sub-menu single" style="left:auto">
						<?php } else if($megaheader['col']==2) {?>
							<div class="sub-menu double " style="left:auto">
						<?php } else if($megaheader['col']==3) {?>
							<div class="sub-menu triple ">
							<div class="container">
						<?php } else {?>
							<div class="sub-menu sub1">
							<div class="container">
						<?php } ?>
					
						<?php if($megaheader['bgimagetype']=='uploadimage'){?>
							<div class="content bgcontent" <?php if(!empty($megaheader['background'])) {?>style="background:url('<?php echo $megaheader['background']?>') <?php echo $dropdownbg;?>; background-repeat:no-repeat;background-position:right top;min-height:<?php echo $megaheader['bgimageheight']?>px;" <?php } else{ ?>
							style="background:<?php echo $dropdownbg;?>"<?php } ?>> 
			 
						<?php } elseif($megaheader['bgimagetype']=='selectpattern') { ?>
							<div class="content" <?php if(!empty($megaheader['ptrnbackground'])) {?>style="background:url('<?php echo $megaheader['ptrnbackground']?>') <?php echo $dropdownbg;?>;"<?php } else{ ?>style="background:<?php echo $dropdownbg;?>"<?php } ?> />
			  
						<?php } else { ?>
							<div class="content"  style="background:<?php echo $dropdownbg;?>" >  
						<?php } ?>
					
						<div class="mobile-enabled">
							<div class="row">
								<div class="col-sm-12 hover-menu">
									<div class="menu">
									<?php if(!empty($megaheader['sublink'])) { ?>
										<?php foreach (array_chunk($megaheader['sublink'], ceil(count($megaheader['sublink']) / $megaheader['col'])) as $children) { 
										 
										?>
										
										<?php if($megaheader['col']==1){?>
											<ul class="list-unstyled main_li">
										<?php } else { ?>
											<ul class="list-unstyled main_li multiple">
										<?php } ?>
											
										<?php foreach ($children as $child) {	
										
										?>
											<?php if($megaheader['col']==1){?>
												<li class="information">
											<?php } else { ?>
												<li>
											<?php } ?>
											<?php $child['main']=true; if($child['main']) { ?>
												<div  class="main_link">
												<?php if($megaheader['col']==1){?>
													<div class="catemenu1">
												<?php } else { ?>
													<div class="catemenu <?php if(!empty($child['image'])){?> catemenu2<?php } ?>">
												<?php } ?>
							
												<?php if($child['type']=='product'){ ?>	
													<h3 class="producthover">
												<?php } else { ?>
													<?php if($megaheader['col']==1){?>
														<h3 class="subtitle1">
													<?php } else {?>
												<h3 class="subtitle">
												<?php }?>
												<?php } ?>
												
												<a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?> </a>
												
												<?php if(!empty($child['sublink']) && $megaheader['col']==1) { ?> 
												<div class="arrowiocn pull-right">
												<i class="fa fa-caret-right hidden-xs" aria-hidden="true"></i>
												<i class="fa fa-caret-down visible-xs" aria-hidden="true"></i>
												</div>
												<?php } ?>
												
												</h3>
												<?php if(!empty($child['image'])) { ?>
													<div class="thumb"><a href="<?php echo $child['href']; ?>"><img alt="" class="img-responsive" src="<?php echo $child['image']?>" /></a></div>
												<?php } ?>	
												
												<!-- extra subcategory -->
										<?php $r=1;
										if(!empty($child['sublink'])) { ?>
										<?php if($megaheader['col']==1) { ?>
										<ul class="list-unstyled subcategory subcatcols">
										<?php } else { ?>
										<ul class="list-unstyled subcategory">
										<?php } ?>
											<?php foreach($child['sublink'] as $subcategory){ ?>
											<?php $subclass="";
											if($r>$subcategorylimit){
											 $subclass="class='showsub' style='display:none'";
											} ?>
											<li <?php echo $subclass?>>
												<a href="<?php echo $subcategory['href']; ?>">
												<?php echo $subcategory['name']; ?>
												<?php if($subcategory['description']) { ?>
													<p class="hide"><?php echo !empty($subcategory['description']) ? $subcategory['description']:'' ; ?></p>
												<?php } ?>
												</a>
											</li>
											<?php if($r==$subcategorylimit){ ?>
											<li class="showsub2 hide">
												<a href="javascript:;" onClick="$('.showsub').show();$('.showsub1').show();$('.showsub2').hide();">see more</a>
											</li>
											<?php } ?>
											<?php $r++; } ?>
											<?php if($r>$subcategorylimit){?>
												<li class="showsub" style="display:none"><a href="javascript:;" onClick="$('.showsub2').show();$('.showsub').hide();"><?php echo $hide_more?></a></li>
											<?php } ?>
											<?php if($megaheader['col']==1) { ?>
											</ul> 
											<?php } else {?>
											</ul>
											<?php } ?>
										<?php } ?>
										<!-- extra subcategory -->
												
												</div>	
												
													<?php if(!empty($child['price'])) { ?>
														<ul class="list-unstyled product-detail">
															<li><?php echo !empty($child['model']) ? $child['model']:'' ; ?></li>
															<li><?php echo !empty($child['sku']) ? $child['sku']:'' ; ?></li>
															<li><?php echo !empty($child['upc']) ? $child['upc']:'' ; ?></li>
															<li><?php echo !empty($child['price']) ? $child['price']:'' ; ?></li>
															<li><?php echo !empty($child['special']) ? $child['special']:'' ; ?></li>
															<li><p><?php echo !empty($child['description']) ? $child['description']:'' ; ?></p></li>
														</ul>
													<?php } ?>
												</div>
											<?php } ?>
										
										<!-- extra products -->
										<?php if(!empty($child['product'])) { ?>
											<ul class="list-unstyled extra_products">
											<?php foreach($child['product'] as $product){ ?>
												<li>
													<a href="<?php echo $product['href']; ?>">
														<h3><?php echo $product['name']; ?></h3>
														
														<?php if(!empty($product['image'])) { ?>
															<div class="thumb"><img class="img-responsive" src="<?php echo $product['image']?>" /></div>
														<?php } ?>
														<?php if(!empty($product['model'] || $product['sku'] || $product['upc'] || $product['price'])) { ?>
														<ul class="list-unstyled product-detail">
															<li><?php echo !empty($product['model']) ? $product['model']:'' ; ?></li>
															<li><?php echo !empty($product['sku']) ? $product['sku']:'' ; ?></li>
															<li><?php echo !empty($product['upc']) ? $product['upc']:'' ; ?></li>
															<li><?php echo !empty($product['price']) ? $product['price']:'' ; ?></li>
															<li><?php echo !empty($product['special']) ? $product['special']:'' ; ?></li>
															<li><p><?php echo !empty($product['description']) ? $product['description']:'' ; ?></p></li>
														</ul>
														<?php } ?>
													</a>
												</li>
											<?php } ?>
											</ul>
										<?php } ?>
										<!-- extra products -->
										</li>
										<?php } ?>
										</ul>
									<?php } } ?>
									
									<?php if(!empty($megaheader['editor'])) {?>
						
										<?php if(!empty($megaheader['background'])) {?>
											<div> <?php echo $megaheader['editor']?></div>
										<?php } else{?>
											<div style="width:99%"> <?php echo $megaheader['editor']?></div>
									<?php } }?>
			
									</div>
								</div>
							</div>
						</div>
					<!--content close-->
					</div>
					<!--content close-->
					
					<?php if($megaheader['col']==1){?>
						</div>
					<?php } else if($megaheader['col']==2) {?>
						</div>
					<?php } else if($megaheader['col']==3) {?>
						</div>
							</div>
					<?php } else {?>
						</div>
							</div>
					<?php } ?>
						
					</li>
					<?php } else { ?>
						<li class="with-sub-menu hover" >
							<?php if($megaheader['showicon']==1){?>
								<a href="<?php echo $megaheader['href']; ?>"> <i class="fa <?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i></a>
							<?php } else {?>
								<a class="menutitle" href="<?php echo $megaheader['href']; ?>" <?php if($megaheader['openew']) {?>target="_blank"<?php }?> >
								<?php if(!empty($megaheader['menu_label'])){ ?>
							
							<span class="toplable"><?php echo $megaheader['menu_label'];?></span>
							<?php } ?>
								<i class="fa <?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i> <?php echo $megaheader['title']; ?></a>
							<?php } ?>
						</li>
					<?php } ?>
				<?php } ?>
				</ul>
			</div>	
		
		</div>
		
		<?php if($menuexpend==1){ ?>
			</div>
		<?php } ?>
	</nav>
	<?php if($menuexpend==0){ ?>
		</div>
	<?php } ?>
</div>
<?php } ?>
<style>
#menu{background:<?php echo $headercontainer;?>!important;}
.with-sub-menu{background:<?php echo $menubgtitle;?>!important;}
.menutitle{color:<?php echo $headertitlecolor;?>;!important;font-size:<?php echo $headertitlesize;?>px!important}
ul.megamenu > li > a{color:<?php echo $headertitlecolor;?> !important;}
    .menutitle:hover{color:<?php echo $headertitlehovcolor;?> !important;}
ul.megamenu > li .open-menu{color:<?php echo $headertitlecolor;?> !important;}
.with-sub-menu:hover{background:<?php echo $menubghovtitle;?>!important;}
.subtitle{color:<?php echo $dropdownbgtitle;?>!important;}
.subtitle:hover{color:<?php echo $headertitlehovcolor;?>!important;}
.product-detail li{color:<?php echo $headersublink;?>!important;font-size:<?php echo $headerlinksize;?>px!important}
.subcategory li a{color:<?php echo $headersublink;?>!important;font-size:<?php echo $headerlinksize;?>px!important}
.product-detail li:hover,.extra_products li h3:hover{color:<?php echo $headerhlink;?>!important;}

.catemenu1 h3 a:hover{color:<?php echo $headertitlehovcolor;?>!important;}
.fonticon{color:<?php echo $headertitlecolor;?>}
.dropdown-menu p{color:<?php echo $headertitlecolor;?>!important;}
.navbar-header{background:<?php echo $headercontainer;?>!important;border-color:<?php echo $headercontainer;?>!important;}
#mega_menu #category{color:<?php echo $headertitlecolor;?>;!important;}
#mega_menu .btn-navbar{background:<?php echo $mobilbtn_bgcolor;?>!important; border-color:<?php echo $headertitlecolor;?>!important; color:<?php echo $dropdownbg;?>!important;}

#mega_menu ul.megamenu > li > .sub-menu.single .content ul .main_link h3 a{font-size:<?php echo $headerlinksize;?>px!important; color:<?php echo $headersublink;?>;}

#mega_menu ul .subcatcols{background:<?php echo $dropdownbg;?>}

#mega_menu .fa-caret-right {color:<?php echo $headersublink;?>!important; font-size:<?php echo $headerlinksize;?>px!important;}

#mega_menu .extra_products h3{font-size:<?php echo $headerlinksize;?>px!important;}

#mega_menu ul.megamenu > li > a{text-transform:<?php echo $fonttype; ?>;}

#mega_menu .catemenu2 .subtitle, #mega_menu .catemenu2 .producthover{font-size:<?php echo $headertitlesize;?>px!important;font-weight:<?php echo $fontweight; ?>;text-transform:<?php echo $fonttype; ?>;}

#mega_menu .subtitle a{font-size:<?php echo $headertitlesize;?>px!important;font-weight:<?php echo $fontweight; ?>;text-transform:<?php echo $fonttype; ?>;}

.toplable::before{background-color:<?php echo $labelbg;?>!important;}
.toplable{background-color:<?php echo $labelbg;?>!important; color:<?php echo $labeltextcolor;?>!important;}
.subcategory li a:hover{color:<?php echo $headerhlink;?>!important;}
#mega_menu .catemenu a:hover, #mega_menu .producthover a:hover{color:<?php echo $headerhlink;?>!important;}
  @media (max-width:1000px){
    .menutitle{
        font-size: 12px !important;
    }
  }
</style>
<script type="text/javascript">
  $(window).load(function(){
      var css_tpl = '<style type="text/css">';
      css_tpl += 'ul.megamenu li .sub-menu .content {';
      css_tpl += '-webkit-transition: all 500ms ease-out !important;';
      css_tpl += '-moz-transition: all 500ms ease-out !important;';
      css_tpl += '-o-transition: all 500ms ease-out !important;';
      css_tpl += '-ms-transition: all 500ms ease-out !important;';
      css_tpl += 'transition: all 500ms ease-out !important;';
      css_tpl += '}</style>'
    $("head").append(css_tpl);
  });
</script>
