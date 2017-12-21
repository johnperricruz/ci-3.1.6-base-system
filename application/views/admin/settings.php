<?php require_once('inc/head.php'); ?>
<?php $this->load->view('inc/messages'); ?>
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
									<th>
										 #
									</th>
									<th>
										 Settings Name
									</th>
									<th>
										Value
									</th>
									<th class="text-right">
										Action
									</th>
								</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1;
										foreach($settings as $setting){
											echo '
												<tr>
													<td>'.$ctr.'</td>
													<td>'.$setting->settings_name.'</td>
													<td>'.$setting->value.'</td>
													<td class="text-right">
														<a href="#" data-value="'.$setting->value.'" data-name="'.$setting->settings_name.'" data-target="#settings-modal" data-toggle="modal" class="modal-trigger btn btn-warning"><i class="icon-pencil"></i> Edit</a>
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
			<div id="settings-modal" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="modal-title">Change Website Settings
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">×</span>
								</button>
							</h4>
						</div>
						<div class="modal-body">
							<?php echo form_open_multipart('admin/settings/update'); ?>
								<input id="settings_key" name="settings_key" type="hidden" value="" class="form-control"/>
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label id="settings-name" class="control-label">Settings Name</label>
											</div>			
										</div>		
										<div class="col-md-6">										
											<div class="form-group">
												<input id="settings" name="settings" type="text" value="" class="form-control"/>
											</div>	
										</div>	
									</div>	
								</div>	
								<hr/>
								<div align="right">
									<button data-dismiss="modal" type="button" class="btn btn-danger">Close</button>
									<button class="btn btn-success">Save</button>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>	
			<script type="text/javascript">
				$(function(){
					$('.modal-trigger').click(function(){
						$('#settings-name').html($(this).data('name'));
						$('#settings').val($(this).data('value'));
						$('#settings_key').val($(this).data('name'));
					});
				});
			</script>
<?php require_once('inc/footer.php'); ?>