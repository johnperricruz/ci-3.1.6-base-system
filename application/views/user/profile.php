<?php require_once('inc/head.php'); ?>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12">
					<!--BEGIN TABS-->
					<div class="tabbable-line tabbable-full-width">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#overview" data-toggle="tab">
								Personal </a>
							</li>
							<li>
								<a href="#tab_1_3" data-toggle="tab">
								Security </a>
							</li>
						</ul>
						<div class="tab-content p-1">
							<div class="tab-pane active" id="overview">
								<div class="row">
									<div class="col-md-3">
										<ul class="list-unstyled profile-nav">
											<li> 
												<img src="<?php echo base_url('assets/files/users/'.$profile->personal_info_id.'/'.$profile->display_pic.''); ?>" class="img-responsive" title="<?php echo $profile->fname.' '.$profile->lname; ?>" alt="<?php echo $profile->fname.' '.$profile->lname; ?>" draggable="false" />
												<br/>
												<a data-target="#profile-picture-modal" data-toggle="modal" href="#" class="btn btn-warning btn-xs"><span class="fa fa-image"></span> Change Avatar</a>
											</li>
										</ul>
									</div>
									<div id="profile-picture-modal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
											  <div class="modal-header">
												<h4 class="modal-title" id="modal-title">Change Avatar
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													  <span aria-hidden="true">×</span>
													</button>
												</h4>
											  </div>
											  <div class="modal-body">
												<img src="<?php echo base_url('assets/files/users/'.$profile->personal_info_id.'/'.$profile->display_pic.''); ?>" class="img-responsive" title="<?php echo $profile->fname.' '.$profile->lname; ?>" alt="<?php echo $profile->fname.' '.$profile->lname; ?>" draggable="false" />
												<?php echo form_open_multipart('user/profile/update/avatar'); ?>
													<div class="p-1 text-center">
														<input type="file" name="dp" required />
														<hr/>
														<button type="button" data-dismiss="modal" class="btn btn-danger"><span aria-hidden="true">×</span> Cancel</button>
														<button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
													</div>
												<?php echo form_close(); ?>
											  </div>
											</div>
										</div>
									</div>									
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-12 profile-info">
												<?php $this->load->view('inc/messages'); ?>
												<h1><?php echo $profile->fname; ?> <?php echo $profile->mname; ?> <?php echo $profile->lname; ?></h1>
												<p>
													<a href="javascript:;"><?php echo $profile->email_address; ?></a>
												</p>
												<ul class="list-inline">
													<li>
														<i class="fa fa-map-marker"></i> <?php echo $profile->address; ?>
													</li>
													<li>
														<i class="fa fa-calendar"></i> <?php echo $profile->birthday; ?>
													</li>
													<li>
														<i class="fa fa-phone"></i> <?php echo $profile->contact_number; ?>
													</li>
													<li>
														<i class="fa fa-user"></i><?php echo $profile->gender; ?>
													</li>
													<li>
														<i class="fa fa-heart"></i> <?php echo $profile->civil_status; ?>
													</li>
												</ul>
											</div>
											<!--end col-md-8-->

										</div>
										<!--end row-->
										<div class="tabbable-line tabbable-custom-profile">
											<ul class="nav nav-tabs">
												<li class="active">
													<a href="#personal_info" data-toggle="tab">
													Personal Info</a>
												</li>
											</ul>
											<div class="tab-content p-2">
												<div class="tab-pane active" id="personal_info">
													<div class="portlet-body">
														<?php 
														$personal_info_form = array('id' => 'personal_info_form');
														echo form_open('user/profile/update/info',$personal_info_form); ?>
														
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">First Name</label>
																	<input name="fname" type="text" value="<?php echo $profile->fname; ?>" class="form-control"/>
																</div>	
															</div>	
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Middle Name</label>
																	<input name="mname" type="text" value="<?php echo $profile->mname; ?>" class="form-control"/>
																</div>	
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Last Name</label>
																	<input name="lname" type="text" value="<?php echo $profile->lname; ?>" class="form-control"/>
																</div>
															</div>
														</div>
														
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label class="control-label">Address</label>
																	<input name="address" type="text" value="<?php echo $profile->address; ?>" class="form-control"/>
																</div>	
															</div>	
														</div>	
															
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Company</label>
																	<input name="company" type="text" value="<?php echo $profile->company; ?>" class="form-control"/>
																</div>	
															</div>														
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Email Address</label>
																	<input id="email_address" name="email_address" type="email" value="<?php echo $profile->email_address; ?>" class="form-control"/>
																</div>	
															</div>	
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Contact Number</label>
																	<input name="contact_number" type="text" value="<?php echo $profile->contact_number; ?>" class="form-control"/>
																</div>	
															</div>																
														</div>		

														<hr/>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Birthday</label>
																	<input name="birthday" type="date" value="<?php echo $profile->birthday; ?>" class="form-control"/>
																</div>	
															</div>															
															<div class="col-md-4">
																<label class="control-label">Civil Status</label>
																<div class="form-group">
																	<select name="civil_status" class="form-control custom-select">
																		<?php 
																			foreach(civil_status() as $key => $val){
																				$selected = '';
																				if($val == $profile->civil_status){
																					$selected = 'selected';
																				}
																				echo '<option '.$selected.' value="'.$val.'">'.$key.'</option>';
																			}
																		?>
																	</select>						
																</div>																	
															</div>	
															<div class="col-md-4">
																<label class="control-label">Gender</label>
																<div class="form-group">
																	<label class="form-check-label">
																		<input <?php echo $profile->gender == 'Male' ? 'checked' : false ; ?> class="form-check-input" type="radio" name="gender" id="male" value="Male">Male
																	</label>&nbsp;&nbsp;&nbsp;
																	<label class="form-check-label">
																		<input <?php echo $profile->gender == 'Female' ? 'checked' : false ; ?> class="form-check-input" type="radio" name="gender" id="female" value="Female">Female
																	</label>						
																</div>																	
															</div>																
														</div>
														
														<div class="row">
															<div class="col-md-12">
																<div class="form-group text-right">
																	<button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
																</div>
															</div>
														</div>
														
														<?php echo form_close(); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--tab_1_2-->
							<div class="tab-pane" id="tab_1_3">
								<div class="row profile-account">
									<div class="col-md-3">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
	
											<li class="active">
												<a data-toggle="tab" href="#change_pass">
												<i class="fa fa-lock"></i> Account Security </a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content p-1">
											<?php 
											$username_form = array('id' => 'username_form');
											echo form_open('user/profile/update/username',$username_form); ?>
													<div class="form-group">
														<label class="username-label control-label">Username</label>
														<input required id="username" name="username" type="text" value="<?php echo $profile->username; ?>" class="form-control" required />
													</div>			
													<div class="margin-top-10">
														<button id="btn-username" class="btn green">Update Username</button>
													</div>													
											<?php echo form_close(); ?>
											<hr/>
											<?php
											$password_form = array('id' => 'password_form');
											echo form_open('user/profile/update/password',$password_form); ?>											
													<div class="form-group">
														<label class="control-label">Current Password</label>
														<input name="current" type="password" class="form-control" required />
													</div>
													<div class="form-group">
														<label class="control-label">New Password</label>
														<input id="new" name="new" type="password" class="form-control" required/>
													</div>
													<div class="form-group">
														<label class="control-label">Re-type New Password</label>
														<input id="confirm" name="confirm" type="password" class="form-control" required/>
													</div>
													<div class="margin-top-10">
														<button class="btn green">Update Password</button>
													</div>
												<?php echo form_close(); ?>
											</div>
										</div>
									</div>
									<!--end col-md-9-->
								</div>
							</div>
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
			<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
			<script type="text/javascript">
				// just for the demos, avoids form submit
				// jQuery.validator.setDefaults({
				  // debug: true,
				  // success: "valid"
				// }); 
				$( "form#username_form" ).validate ({
					rules: {
						username : {
							remote: {
								   url: "<?php echo base_url('ajax/profile/check-username/'.$profile->personal_info_id.''); ?>",
								   data: {
									   username: function () {
										   return $("#username").val();
									   }
								   }
							   }
						}
						
					},
					messages:{
						username : "Username is already in use."
					}
				});
				$( "form#personal_info_form" ).validate ({
					rules: {
						email_address : {
							remote: {
								   url: "<?php echo base_url('ajax/profile/check-email/'.$profile->personal_info_id.''); ?>",
								   data: {
									   email_address: function () {
										   return $("#email_address").val();
									   }
								   }
							   }
						}
						
					},
					messages:{
						email_address : "Email address is already in use."
					}
				});				
				$( "form#password_form" ).validate ({
					rules: {
						confirm: {
						  equalTo: "#new"
						}	
					},
					messages:{
						confirm : "Password did not match."
					}					
				});
			</script>		
<?php require_once('inc/footer.php'); ?>