<?php $GLOBALS['option_value_count'] = 0;?>

<?php if($status == 'Approved' || $status == 'Rejected' || $status == 'Cancelled'):?>

<?php echo form_open($this->config->item('admin_folder').'/leaves/admin_form/'.$id ); ?>
	<div class="row">
		<div class="span8">
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#leave_details" data-toggle="tab"><?php echo lang('details');?></a></li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane active" id="leave_details">
				
					<div class="row">
						<div class="span8">
							<?php echo lang('name')?>: <?php echo $firstname ?> <?php echo $lastname ?>
						</div>
					</div>
					
					<div class="row">
						<div class="span8">
							<?php echo lang('email')?>: <?php echo $email ?>
						</div>
					</div>
					<div class="row">
						<div class="span8">
							<?php echo lang('application_date')?>: <?php echo date("d-m-Y") ?>
						</div>
					</div>
					
					<div class="row">
					&nbsp;
					</div>
					
					<div class="row">
						<div class="span8">
							<label><?php echo lang('leave_type')?>: <?php echo $leave_type ?> </label>												
						</div>
					</div>
					
					<div class="row">
						<div class="span8">
							<label for="no_of_day"><?php echo lang('no_of_day');?>: <?php echo $qty ?> </label>						
						</div>				
					</div>
					
					<div class="row">
						<div class="span8">
							<label for="datefrom"><?php echo lang('datefrom');?>: <?php echo $datefrom ?> </label>						
						</div>				
					</div>
					
					<div class="row">
						<div class="span8">
							<label for="dateto"><?php echo lang('dateto');?>: <?php echo $dateto ?> </label>						
						</div>				
					</div>
					
					<div class="row">
						<div class="span8">
							<label><?php echo lang('day_leave_type')?>: <?php echo $day_type ?></label>												
						</div>
					</div>	
													
					<fieldset>
							     					
						<label for="content"><?php echo lang('reason');?>: <?php echo $reason?></label>					
								
					</fieldset>							
		
					<div class="row">
						<div class="span8">
							<label><?php echo lang('current_status')?>: <b><?php echo $status?></b></label>												
						</div>
					</div>					
	
					<div class="row">
						<div class="span8">
														
							<label><?php echo lang('update_status')?>:</label>
																
							<?php		
								if($this->auth->check_access('Admin')) :
								
									if($status == 'Approved'):
										$options['Rejected'] = lang('rejected');
									elseif($status == 'Rejected'):									
										$options['Approved'] = lang('approved');
									else:
										$options['Rejected'] = lang('rejected');
										$options['Approved'] = lang('approved');
									endif;																					
																			 	
									echo form_dropdown('status', $options, set_value('status',$status), 'class="span2"');								
								else:
									echo '<b>'.$status.'</b>';
								endif;
							?>																					
								
																			
						</div>
					</div>	
				
				</div>
				
			</div>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>				
	</div>
</form>

<?php else:?>
		
		<?php  if($this->auth->check_access('Admin')) : ?>
		
			<?php echo form_open($this->config->item('admin_folder').'/leaves/admin_form/'.$id ); ?>
			<div class="row">
			<div class="span8">
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#leave_details" data-toggle="tab"><?php echo lang('details');?></a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="leave_details">
					
						<div class="row">
							<div class="span8">
								<?php echo lang('name')?>: <?php echo $firstname ?> &nbsp; <?php echo $lastname ?>
							</div>
						</div>
						
						<div class="row">
							<div class="span8">
								<?php echo lang('email')?>: <?php echo $email ?>
							</div>
						</div>
						<div class="row">
							<div class="span8">
								<?php echo lang('application_date')?>: <?php echo date("d-m-Y") ?>
							</div>
						</div>
						
						<div class="row">
						&nbsp;
						</div>
						
						<div class="row">
							<div class="span8">
								<label><?php echo lang('leave_type')?>: <?php echo $leave_type ?> </label>												
							</div>
						</div>
						
						<div class="row">
							<div class="span8">
								<label for="no_of_day"><?php echo lang('no_of_day');?>: <?php echo $qty ?> </label>						
							</div>				
						</div>
						
						<div class="row">
							<div class="span8">
								<label for="datefrom"><?php echo lang('datefrom');?>: <?php echo $datefrom ?> </label>						
							</div>				
						</div>
						
						<div class="row">
							<div class="span8">
								<label for="dateto"><?php echo lang('dateto');?>: <?php echo $dateto ?> </label>						
							</div>				
						</div>
						
						<div class="row">
							<div class="span8">
								<label><?php echo lang('day_leave_type')?>: <?php echo $day_type ?></label>												
							</div>
						</div>	
														
						<fieldset>
								     					
							<label for="content"><?php echo lang('reason');?>: <?php echo $reason?></label>					
									
						</fieldset>							
		
						<div class="row">
							<div class="span8">
								<label><?php echo lang('status')?>: </label>																				
							<?php			
									if($status == 'Approved'):
										$options['Rejected'] = lang('rejected');
									elseif($status == 'Rejected'):									
										$options['Approved'] = lang('approved');
									else:
										$options['Rejected'] = lang('rejected');
										$options['Approved'] = lang('approved');
									endif;														 	
			
									echo form_dropdown('status', $options, set_value('status',$status), 'class="span2"');								
							?>																					
							</div>
						</div>	
					
					</div>
					
				</div>
			</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>				
			</div>
			</form>
		
		<?php else: ?>
		
		<?php echo form_open($this->config->item('admin_folder').'/leaves/form/'.$id, "id = 'application_form' "); ?>
		<div class="row">
			<div class="span8">
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#leave_details" data-toggle="tab"><?php echo lang('details');?></a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="leave_details">
					
						<div class="row">
							<div class="span8">
								<?php echo lang('name')?>: <?php echo $firstname ?> &nbsp; <?php echo $lastname ?>
							</div>
						</div>
						
						<div class="row">
							<div class="span8">
								<?php echo lang('email')?>: <?php echo $email ?>
							</div>
						</div>
						<div class="row">
							<div class="span8">
								<?php echo lang('application_date')?>: <?php echo date("d-m-Y") ?>
							</div>
						</div>
						
						<?php if($id):?>
						<div class="row">
							<div class="span8">
								<?php echo lang('status')?>: <?php echo $status ?>
							</div>
						</div>
						<?php endif;?>
						
						<div class="row">
						&nbsp;
						</div>
						
						<div class="row">
							<div class="span8">
								<label><?php echo lang('leave_type')?>:</label>
									<input type="radio" name="leave_type" value="Annual Leave" checked> <?php echo lang('annual_leave')?>
									<input type="radio" name="leave_type" value="Sick Leave" > <?php echo lang('sick_leave')?>
									<input type="radio" name="leave_type" value="Emergency Leave" > <?php echo lang('emergency_leave')?>											
									
								
							</div>
						</div>
						
						<!--div class="row">
							<div class="span8">
								<label for="no_of_day"><?php echo lang('no_of_day');?> </label>
								<?php
								$data	= array('name'=>'qty', 'value'=>set_value('qty', $qty), 'class'=>'span2');
								echo form_input($data);
								?>
							</div>				
						</div-->
						
						<div class="row">
							<div class="span8">
								<label for="datefrom"><?php echo lang('datefrom');?> </label>
								<?php
								$data	= array('name'=>'datefrom', 'value'=>set_value('datefrom', $datefrom), 'class'=>'span2', 'id'=>'select_datefrom');
								echo form_input($data);
								?>
								<input id="date_alt" type="hidden" name="start_date" />
							</div>				
						</div>
						
						<div class="row">
							<div class="span8">
								<label for="dateto"><?php echo lang('dateto');?> </label>
								<?php
								$data	= array('name'=>'dateto', 'value'=>set_value('dateto', $dateto), 'class'=>'span2', 'id'=>'select_dateto');
								echo form_input($data);
								?>
								<input id="date_to_alt" type="hidden" name="end_date" />
							</div>				
						</div>
						
						<div class="row">
							<div class="span8">
								<label><?php echo lang('day_leave_type')?>:</label>						
								<?php
							 	$options = array(	 'Full Day Leave'	=> lang('full_day')
													,'First Half Leave'	=> lang('first_half')
													,'Second Half Leave'	=> lang('second_half')
													);
								echo form_dropdown('day_type', $options, set_value('day_type',$day_type), 'class="span3"');
								?>
							</div>
						</div>	
						
						
						
						<fieldset>
								     					
							<label for="content"><?php echo lang('reason');?></label>
							<?php
							$data	= array('name'=>'reason', 'class'=>'redactor', 'value'=>set_value('reason', html_entity_decode($reason)));
							echo form_textarea($data);
							?>
									
						</fieldset>							
		
					
					</div>
		
					
					
					
				</div>
			</div>
			
		</div>
				
		<div class="form-actions">
			<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
			<?php if($id):?>
				<a id="cancel" class="btn btn-primary"><?php echo lang('cancel');?></a>
			<?php endif;?>
		</div>
		</form>
		
		<?php endif; ?>
		

<?php endif;?>

<script>

var site_url = "<?php echo site_url() ?>";
var base_url = "<?php echo $this->config->item('admin_folder')?>";
var recordID = "<?php echo $id ?>";

$('#select_datefrom').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

$("#cancel").click(function(){ 
		var r = confirm("Confirm to Cancel your leave application?");
		if (r == true) {			
			document.getElementById('application_form').action = site_url + base_url + "/" + "leaves/cancel_form/" + recordID;
			$('#application_form').submit();			
		}
});


</script>
