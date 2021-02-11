<!DOCTYPE html>
<html class="no-js" lang="eng">

<head>
	<?php include "Includes_top.php"?>
	<title>Register</title>
</head>

<body class="admin">
	<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
	<![endif]-->

	<div class="preloader">
		<div class="preloader_image"></div>
	</div>

	

	<!-- wrappers for visual page editor and boxed version of template -->
	<div id="canvas">
		<div id="box_wrapper">

			<!-- template sections -->
			<section class="ls section_padding_top_100 section_padding_bottom_100 section_full_height">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 to_animate">
							<div class="with_border with_padding">

								<h4 class="text-center">
									Sign Up New E-Waste Account
								</h4>
								<hr class="bottommargin_30">
								<div class="wrap-forms">

                                    <div id="message"></div>
                                    
									<?php $attributes = array("name" => "regform", 'id'=>'regform');
                                     echo form_open("login/register_client", $attributes);?>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group has-placeholder">
													<label for="name">Your Name</label>
													<i class="grey fa fa-user"></i>
													<input type="text" class="form-control" id="name" name="name" placeholder="Name">
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group has-placeholder">
													<label for="email">Email address</label>
													<i class="grey fa fa-envelope-o"></i>
													<input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group has-placeholder">
													<label for="password">Password</label>
													<i class="grey fa fa-pencil-square-o"></i>
													<input type="password"  name="password" class="form-control" id="password" placeholder="Password">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group has-placeholder">
													<label for="password2">Retype Password</label>
													<i class="grey fa fa-pencil-square-o"></i>
													<input type="password" name="password2" class="form-control" id="password2" placeholder="Retype Password">
												</div>
											</div>
										</div>

										<!-- <div class="row">
											<div class="col-sm-12">
												<div class="checkbox">
													<input type="checkbox" id="remember_me_checkbox">
													<label for="remember_me_checkbox">Remember Me
													</label>
												</div>
											</div>
										</div> -->
										<button type="submit" class="theme_button block_button color1">Create an account</button>
									</form>
								</div>

							</div>
							<!-- .with_border -->

							<p class="divider_20 text-center">
					Already registered? <a href="<?php echo base_url()?>login">Log In</a>.
				</p>

						</div>
						<!-- .col-* -->
					</div>
					<!-- .row -->
				</div>
				<!-- .container -->
			</section>
		</div>
		<!-- eof #box_wrapper -->
	</div>
	<!-- eof #canvas -->

	<?php include "includes_bottom.php" ?>

</body>
</html>