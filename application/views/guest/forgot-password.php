<?php require_once('inc/head.php'); ?>
<!-- BEGIN LOGO -->
<div class="logo">
	<h2><a href="<?php echo base_url(); ?>"><?php echo $title; ?></a></h2>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->

	<?php echo form_open('forgot-password/send'); ?>
		<h3 class="form-title">Forgotten Password</h3>
		<?php $this->load->view('inc/messages.php'); ?>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter email address. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email Address</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email Address" name="email_address" required />
			</div>
		</div>
		
		<div class="form-actions text-right">
			<button type="submit" class="btn green-haze">
			Send Reset Link <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="forget-password">
			<h4>Login ?</h4>
			<p>
				no worries, click <a href="<?php echo base_url(); ?>" id="forget-password">
				here </a>
				to get back on the login page
			</p>
		</div>
	<?php echo form_close(); ?>
	<!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 <?php echo date('Y'); ?> &copy; <?php echo $title; ?>
</div>	
<?php require_once('inc/footer.php'); ?>