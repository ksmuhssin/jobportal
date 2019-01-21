<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700%7CSource+Sans+Pro:300,400,600,700" rel="stylesheet">
<link href="catalog/view/theme/jobportal/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/jobportal/stylesheet/responsive.css" rel="stylesheet">
<!--bootstrap selecter-->
<script src="catalog/view/javascript/jquery/dist/js/bootstrap-select.js" type="text/javascript"></script>
<link href="catalog/view/javascript/jquery/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<!--bootstrap selecter-->
<!--mega menu file-->
			<link href="catalog/view/theme/jobportal/stylesheet/megaheader.css" rel="stylesheet">			
			<script type="text/javascript" src="catalog/view/theme/jobportal/megamenu/megamenu.js"></script>
			<link rel="stylesheet" type="text/css" href="catalog/view/theme/jobportal/megamenu/menu.css">
			<script type="text/javascript">
					var responsive_design = 'yes';
			</script>
			<!--mega menu file-->
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<?php if($lang=='ar') { ?>
	<link href="catalog/view/theme/jobportal/stylesheet/bootstrap-rtl.css" rel="stylesheet">
	<link href="catalog/view/theme/jobportal/stylesheet/bootstrap-rtl.min.css" rel="stylesheet">
	<link href="catalog/view/theme/jobportal/stylesheet/rtl.css" rel="stylesheet">
<?php } ?>
</head>
<body class="<?php echo $class; ?>">
<div class="header3">
<!-- top start here -->
    <nav id="top">
		<div class="container">
			<div id="top-links" class="nav">
				<!-- links start here -->
				<ul class="list-inline button pull-right">
					<li>
						<a href="<?php echo $contact; ?>"><i class="fa fa-phone-square" aria-hidden="true"></i><span><?php echo $telephone; ?></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><i class="fa fa-envelope" aria-hidden="true"></i><span><?php echo $email; ?></span></a>
					</li>
				</ul>
				<!-- links end here -->
				<!-- social icon start here -->
				<ul class="list-inline pull-left icon">
                    <li><?php echo $language; ?></li>
					<?php if($fburl){?>
                      <li>
                        <a href="<?php echo $fburl; ?>" target="new"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($twitter){?>
                      <li>
                        <a href="<?php echo $twitter; ?>" target="new"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($google){?>
                      <li>
                        <a href="<?php echo $google; ?>" target="new"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($instagram){?>
                      <li>
                        <a href="<?php echo $instagram; ?>" target="new"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
                      <?php if($linkedin){?>
                      <li>
                        <a href="<?php echo $linkedin; ?>" target="new"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                      </li>
                      <?php } ?>
				</ul>
				<!-- social icon end here -->
			</div>
		</div>
	</nav>
<!-- top end here -->	

<!-- header start here-->
	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<!-- logo start here -->
					<div id="logo">
						<?php if ($logo) { ?>
						<a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
						<?php } else { ?>
						<h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
						<?php } ?>
					</div>
					<!-- logo end here -->
				</div>
				<div class="col-sm-4">
					<?php echo $search; ?>
				</div>
				<div class="col-sm-3">
					<!-- buttons start here -->
					<div class="button-login pull-right">
						<?php if(!empty($employlogged)==$companeylogged){ ?>
						<button type="button" class="btn btn-default btn-lg" onclick="location.href='<?php echo $login; ?>'"><?php echo $text_login; ?>
						</button>
					
						<?php  } elseif ($companeylogged) { ?>
						<button type="button" class="btn btn-default btn-lg" onclick="location.href='<?php echo $looutempl; ?>'"><?php echo $text_logout; ?>
						</button>
						<button type="button" class="btn btn-primary btn-lg" onclick="location.href='<?php echo $submitjob; ?>'"><?php echo $text_submitjob; ?>
						</button>
						<?php } else{ ?>
						<button type="button" class="btn btn-default btn-lg" onclick="location.href='<?php echo $logoutempl; ?>'"><?php echo $text_logout; ?></button>
						<?php } ?>
					</div>
					<!-- buttons end here -->
				</div>
			</div>
		</div>
	</header>
<!-- header end here-->

<!-- menu start here -->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $megaheaders;?>
            <?php if ($categories) { ?>
			<nav id="menu" class="navbar">
				<div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
					<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse padd0">
					<ul class="nav navbar-nav">
						<?php foreach ($categories as $category) { ?>
						<?php if ($category['children']) { ?>
						<li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
							<div class="dropdown-menu">
								<div class="dropdown-inner">
									<?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
									<ul class="list-unstyled">
										<?php foreach ($children as $child) { ?>
										<li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
										<?php } ?>
									</ul>
									<?php } ?>
								</div>
								<a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a>
							</div>
						</li>
						<?php } else { ?>
						<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
						<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</nav>
            <?php } ?>
		</div>
	</div>
</div>	
<!-- menu end here -->

</div>
