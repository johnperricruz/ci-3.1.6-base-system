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
						</ul>
						<div class="tab-content p-1">
							<div class="tab-pane active" id="overview">
								<div class="row">
									<div class="col-md-3">
										<ul class="list-unstyled profile-nav">
											<li> 
												<img src="//placehold.it/250x250" alt="" draggable="false" />
												<br/>
											</li>
										</ul>
									</div>								
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-12 profile-info">
												<?php $this->load->view('inc/messages'); ?>
												<h1 id="name"></h1>
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
														<?php echo form_open('admin/user/add/info'); ?>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">First Name*</label>
																	<input name="fname" type="text" value="" class="form-control" required/>
																</div>	
															</div>	
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Middle Name</label>
																	<input name="mname" type="text" value="" class="form-control"/>
																</div>	
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Last Name*</label>
																	<input name="lname" type="text" value="" class="form-control" required/>
																</div>
															</div>
														</div>
														
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label class="control-label">Address</label>
																	<input name="address" type="text" value="" class="form-control"/>
																</div>	
															</div>	
														</div>	
															
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Company</label>
																	<input name="company" type="text" value="" class="form-control"/>
																</div>	
															</div>														
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Email Address*</label>
																	<input id="email_address" name="email_address" type="email" value="" class="form-control" required/>
																</div>	
															</div>	
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Contact Number*</label>
																	<input name="contact_number" type="text" value="" class="form-control" required/>
																</div>	
															</div>																
														</div>		

														<hr/>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Birthday</label>
																	<input name="birthday" type="date" value="" class="form-control"/>
																</div>	
															</div>															
															<div class="col-md-4">
																<label class="control-label">Civil Status</label>
																<div class="form-group">
																	<select name="civil_status" class="form-control custom-select">
																		<?php 
																			foreach(civil_status() as $key => $val){
																				echo '<option value="'.$val.'">'.$key.'</option>';
																			}
																		?>
																	</select>						
																</div>																	
															</div>	
															<div class="col-md-4">
																<label class="control-label">Gender</label>
																<div class="form-group">
																	<label class="form-check-label">
																		<input class="form-check-input" type="radio" name="gender" id="male" value="Male">Male
																	</label>&nbsp;&nbsp;&nbsp;
																	<label class="form-check-label">
																		<input class="form-check-input" type="radio" name="gender" id="female" value="Female">Female
																	</label>						
																</div>																	
															</div>																
														</div>
														<hr/>
														
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Role*</label>
																	<select name="role" class="form-control custom-select" required>
																		<?php 
																			foreach(role() as $key => $val){
																				echo '<option value="'.$val.'">'.$key.'</option>';
																			}
																		?>
																	</select>
																</div>																
															</div>														
															<div class="col-md-6">
																<div class="form-group">
																	<label class="username-label control-label">Username*</label>
																	<input id="username" name="username" type="text" value="" class="form-control" required />
																</div>																
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Password*</label>
																	<input id="password" name="password" type="password" class="form-control" required />
																</div>															
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Re-type Password*</label>
																	<input id="confirm" name="confirm" type="password" class="form-control" required/>
																</div>		
															</div>	
														</div>
											
														<div class="row">
															<div class="col-md-12">
																<div class="form-group text-right">
																	<button id="btn-submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
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

						</div>
					</div>
				</div>
				<!--END TABS-->
			</div>
			<!-- END PAGE CONTENT-->
			<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
			<script type="text/javascript">
				// just for the demos, avoids form submit
				// jQuery.validator.setDefaults({
				  // debug: true,
				  // success: "valid"
				// });
				$( "form" ).validate({
					rules: {
						confirm: {
						  equalTo: "#password"
						},
						username : { 
							remote: {
								   url: "<?php echo base_url('ajax/user/check-username'); ?>",
								   data: {
									   username: function () {
										   return $("#username").val();
									   }
								   }
							   }
						},
						email_address : {
							remote: {
								   url: "<?php echo base_url('ajax/user/check-email'); ?>",
								   data: {
									   email_address: function () {
										   return $("#email_address").val();
									   }
								   }
							   }
						}
						
					},
					messages:{
						username: {
							required : "This field is required.",
							remote : "This username is already in use."
						},
						email_address : {
							required : "This field is required.",
							remote : "This email address is already in use."
						}
					}
				});
			</script>			
<?php require_once('inc/footer.php'); ?>