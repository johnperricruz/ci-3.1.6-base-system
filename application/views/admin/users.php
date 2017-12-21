<?php require_once('inc/head.php'); ?>
<div class="row">
				<div class="col-md-12">
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
				</div>
			</div>
<?php require_once('inc/footer.php'); ?>