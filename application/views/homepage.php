 <!DOCTYPE html>
<html class="no-js" lang="eng">
<head>
	<title><?php echo strtoupper($system_abbr)?></title>
	
	<?php include "includes_top.php"?>

</head>

<body>

	<div class="preloader">
		<div class="preloader_image"></div>
	</div>
	<div id="canvas">
		<div id="box_wrapper">

			<!-- template sections -->

			<section class="page_topline cs two_color section_padding_top_5 section_padding_bottom_5 table_section">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6 text-center text-sm-left">
							<p class="divided-content">
					<span class="medium black">
						Welcome to <?php echo strtoupper($system_abbr)?>
					</span>
					<span class="medium black">
						<i class="fa fa-phone"></i>
						 <?php echo $system_phone; ?>
					</span>
				</p>
						</div>
						<div class="col-sm-6 text-center text-sm-right">

							<!-- <div class="widget widget_search">
								<form method="get" class="searchform form-inline" action="http://webdesign-finder.com/html/gogreen/">
									<div class="form-group-wrap">
										<div class="form-group margin_0">
											<label class="sr-only" for="topline-search">Search for:</label>
											<input id="topline-search" type="text" value="" name="search" class="form-control" placeholder="Search Keyword">
										</div>
										<button type="submit" class="theme_button">Search</button>
									</div>
								</form>
							</div> -->
							<!-- <a href="#">Schedule Pickup</a> -->
							<div class="whitelinks">
									<a href="<?php echo $link_facebook; ?>" class="social-icon border-icon rounded-icon soc-facebook"></a>
									<a href="<?php echo $link_twitter; ?>" class="social-icon border-icon rounded-icon soc-twitter"></a>
									<a href="mailto:<?php echo $system_email; ?>" class="social-icon border-icon rounded-icon soc-google"></a>
								</div>


						</div>
					</div>
				</div>
			</section>

			<header class="page_header header_white toggler_xs_right section_padding_20">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 display_table">
							<div class="header_left_logo display_table_cell">
								<a href="index-2.html" class="logo top_logo">
									<img src="<?php echo $this->lm->get_image_url('logo','logo');?>" alt="logo image">
									<span class="logo_text">
										<span class="big"><?php echo strtoupper($system_abbr); ?></span>
										<span class="small-text">Recycling</span>
									</span>
								</a>
							</div>

							<div class="header_mainmenu display_table_cell text-center">
								<!-- main nav start -->
								<nav class="mainmenu_wrapper">
									<ul class="mainmenu nav sf-menu">
										<li class="active">
											<a href="<?php echo base_url()?>">Home</a>
										</li>
										<li class="">
											<a href="#">About</a>
										</li>
										<li class="#">
											<a href="#">FAQs</a>
										</li>
									</ul>
								</nav>
								<!-- eof main nav -->
								<!-- header toggler -->
								<span class="toggle_menu">
									<span></span>
								</span>
							</div>

							<div class="header_right_buttons display_table_cell text-right hidden-xs">
								<!-- <div class="darklinks">
									<a href="#" class="social-icon border-icon rounded-icon soc-facebook"></a>
									<a href="#" class="social-icon border-icon rounded-icon soc-twitter"></a>
									<a href="#" class="social-icon border-icon rounded-icon soc-google"></a>
								</div> -->
								<!-- <div class="col-md-3 col-sm-4 text-center text-sm-right">
									<a href="#" class="theme_button color2 margin_0">Dispose</a>
								</div>

								<div class="col-md-3 col-sm-4 text-center">
									<a href="#" class="theme_button color2 margin_0">Logout</a>
								</div> -->

								<div class="col-md-3 col-sm-4 text-center">
									<?php if ($this->session->userdata('logged_in') == FALSE){ ?>
									<a href="<?php echo base_url()?>login" class="theme_button color2 margin_0">Dispose</a>
								<?php }else{

										$id		 =	$this->session->userdata('id');
										$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 
											if($role=="admin"){?>
												<a href="<?php echo base_url()?>admin/dashboard" class="theme_button color2 margin_0">Dashboard</a>
											<?php }else{ ?>
												<a href="<?php echo base_url()?>client/disposes/new" class="theme_button color2 margin_0">Dispose</a>
											<?php }?>
								<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<section class="intro_section ds">
				<img src="<?php echo base_url()?>components/assets/images/slide.png" alt="">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<div class="slide_description_wrapper">
								<div class="slide_description">
									<div class="intro-layer to_animate" data-animation="fadeInUp">
										<h3 class="highlight text-uppercase text-stroke-white">
											Welcome to
										</h3>
									</div>
									<div class="intro-layer to_animate" data-animation="fadeInUp">
										<h2 class="text-uppercase text-stroke-black">
											<?php echo strtoupper($system_abbr); ?>
										</h2>
									</div>
									<div class="intro-layer to_animate" data-animation="fadeInUp">
										<p style="color: #fff;" class="text-stroke-white">We can solve your waste disposition needs quickly and professionally.<br> Save Your community, Save Your planet</p>
										<?php

										if ($this->session->userdata('logged_in') == FALSE){ ?>
											
										<a href="<?php echo base_url()?>register" class="theme_button color1">Register Now</a>
									<?php } else {
										$id		 =	$this->session->userdata('id');
										$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 
											if($role=="admin"){
											?>
											<a href="<?php echo base_url()?>admin/dashboard" class="theme_button color1">Go to Dashboard</a>
										<?php }else{?>
											<a href="<?php echo base_url()?>client/dashboard" class="theme_button color1">Go to Dashboard</a>
									<?php } }?>
									</div>
								</div>
								<!-- eof .slide_description -->
							</div>
							<!-- eof .slide_description_wrapper -->
						</div>
						<!-- eof .col-* -->
					</div>
					<!-- eof .row -->
				</div>
				<!-- eof .container -->
			</section>

			<section id="about" class="ls section_padding_top_100 section_padding_bottom_150">
				<div class="container">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 text-center">
							<h2 class="section_header">
								Our Services
							</h2>
							<p class="small-text grey">What we offer</p>
							<p class="bottommargin_30">
					<?php echo strtoupper($system_abbr); ?> is a company serving individuals and businesses in Kenya with their computers and electronics upgrade needs, accepting computers and electronics waste in any conditions.
				</p>
							<!-- <img src="images/signature.png" alt="" /> -->
						</div>
					</div>
					<div class="row topmargin_40 columns_margin_top_60">
						<div class="col-md-4">
							<div class="teaser with_border rounded text-center">
								<div class="teaser_icon main_bg_color2 round size_small offset_icon">
									<i class="fa fa-road"></i>
								</div>
								<h4 class="poppins hover-color2">
									<a href="#">Transportation Exp</a>
								</h4>
								<p>
						Guaranteed that all of your universal waste management is performed safely and responsibly.
					</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="teaser with_border rounded text-center">
								<div class="teaser_icon main_bg_color3 round size_small offset_icon">
									<i class="fa fa-inbox"></i>
								</div>
								<h4 class="poppins hover-color3">
									<a href="#">Data destruction exp</a>
								</h4>
								<p>
						We offer business pickup services to safely recycle your electronics in a safe manner.
					</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="teaser with_border rounded text-center">
								<div class="teaser_icon main_bg_color round size_small offset_icon">
									<i class="fa fa-refresh"></i>
								</div>
								<h4 class="poppins">
									<a href="#">Asset Recovery exp</a>
								</h4>
								<p>
						We work with non-profits, businesses, and other organizations to host community e-waste events.
					</p>
							</div>
						</div>
					</div>
				</div>
			</section>

			
			<section class="cs main_color2 section_padding_top_30 section_padding_bottom_30">
				<div class="container">

					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 text-center">
							<h2 class="section_header">
								Contact Us
							</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="media small-teaser teaser inline-block">
								<div class="media-left media-middle">
									<div class="teaser_icon light_bg_color big_bg highlight2 round size_xsmall">
										<i class="fa fa-phone"></i>
									</div>
								</div>
								<div class="media-body media-middle">
									<span class="fontsize_20 medium black"><?php echo $system_phone ?></span>
									<br>
									<span class="small-text small-spacing lightgrey"><?php echo ucwords($system_address) ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="media small-teaser teaser inline-block">
								<div class="media-left media-middle">
									<div class="teaser_icon light_bg_color big_bg highlight2 round size_xsmall">
										<i class="fa fa-google-plus"></i>
									</div>
								</div>
								<div class="media-body media-middle">
									<span class="fontsize_20 medium black">Corporate Mail</span>
									<br>
									<span class="small-text small-spacing lightgrey"><?php echo $system_email ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-0">
							<div class="media small-teaser teaser inline-block">
								<div class="media-left media-middle">
									<div class="teaser_icon light_bg_color big_bg highlight2 round size_xsmall">
										<i class="fa fa-clock-o"></i>
									</div>
								</div>
								<div class="media-body media-middle">
									<span class="fontsize_20 medium black">Open Hours</span>
									<br>
									<span class="small-text small-spacing lightgrey">Weekdays 8.00-18.00, Sat: closed</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			

			

			<section class="ls page_copyright section_padding_15">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<p class="small-text small-spacing grey">&copy; Copyright <?php echo date("Y") ?> | <?php echo $system_name; ?> | All Rights Reserved</p>
						</div>
					</div>
				</div>
			</section>

		</div>
		<!-- eof #box_wrapper -->
	</div>
	<!-- eof #canvas -->

	<?php include "includes_bottom.php"?>
</body>

</html>