<?php require_once('inc/head.php'); ?>
	<div class="row">
		<?php echo form_open('admin/user/delete'); ?>
			<div class="col-md-2">
				<div class="input-group">
					<select name="action" class="form-control">
						<option selected disabled>SELECT ACTION</option>
						<?php 
							foreach(actions() as $action){
								echo '<option value="'.$action.'">'.$action.'</option>';
							}
						?>
					</select>
					<span class="input-group-btn">
						<button type="button" id="confirm" class="btn btn-danger">Go</button>
					</span>						
				</div>					
				<br/>
			</div>
			
			<div class="col-md-12">
			<?php $this->load->view('inc/messages'); ?>
				<!-- BEGIN SAMPLE TABLE PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-cogs"></i>Website Settings
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse" data-original-title="" title="">
							</a>
							<a href="javascript:;" class="remove" data-original-title="" title="">
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-scrollable">
							<table class="table table-hover table-striped">
								<thead>
								<tr>
									<th><input type="checkbox" id="check_all"></th>
									<th>#</th>
									<th>Name</th>
									<th>Email Address</th>
									<th>Contact #</th>
									<th class="text-right">Contact #</th>
								</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1;
										foreach($users as $user){
											echo '
												<tr>
													<td><input name="pid[]" type="checkbox" value="'.$user->personal_info_id.'"/></td>
													<td>'.$ctr.'</td>
													<td>'.$user->fname.' '.$user->lname.'</td>
													<td>'.$user->email_address.'</td>
													<td>'.$user->contact_number.'</td>
													<td class="text-right">
														<a href="'.base_url('admin/user/'.$user->personal_info_id.'').'" class="btn btn-warning"><i class="icon-pencil"></i> Edit</a>
													</td>
												</tr>
												';
											$ctr++;
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			</div>
			
			<!-- END BORDERED TABLE PORTLET-->
			<?php echo form_close(); ?>
	</div>
<?php require_once('inc/footer.php'); ?>