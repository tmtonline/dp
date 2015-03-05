<?php echo form_open($this->config->item('admin_folder').'/leaves/leave_adjustment_form/'.$id, "id = 'application_form' "); ?>
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
						<div class="span8">
							<?php echo lang('application_date')?>: <?php echo date("d-m-Y") ?>
						</div>
					</div>
					
					<div class="row">
		<div class="span5">
			&nbsp;					
		</div>
		<div class="span7">
			<b><?php echo lang('annual_leave_balance')?>:</b> <?php echo isset($annual_left->total) && !empty($annual_left->total) ? $annual_left->total : 0?></br>
			<b><?php echo lang('sick_leave_balance')?>:</b> <?php echo isset($sick_left->total) && !empty($sick_left->total) ? $sick_left->total : 0 ?>
			
		</div>
	</div>
					
					<div class="row">
					&nbsp;
					</div>
					
					<div class="row">
						<div class="span8">
							<label>
							<?php echo lang('adjustment_type')?>:</label>
							<?php
						 	$options = array('in'	=> lang('adjust_in'),
											 'out'	=> lang('adjust_out'));
							echo form_dropdown('adjustment_type', $options, set_value('adjustment_type'), 'class="span3"');
							?>																							
						</div>
					</div>
					
					<div class="row">
						<div class="span8">
							<label><?php echo lang('leave_type')?>:</label>								
								<?php
							 	$options = array('Annual Leave'	=> lang('annual_leave'),
												 'Sick Leave'	=> lang('sick_leave'));
								echo form_dropdown('leave_type', $options, set_value('leave_type'), 'class="span3"');
								?>																		
						</div>
					</div>
					
					<div class="row">
						<div class="span8">
							<label for="no_of_day"><?php echo lang('no_of_day');?> </label>
							<?php
							$data	= array('name'=>'qty', 'value'=>set_value('qty', $qty), 'class'=>'span2');
							echo form_input($data);
							?>
						</div>				
					</div>								
					
					<fieldset>   					
						<label for="content"><?php echo lang('reason');?></label>
						<?php
						$data	= array('name'=>'remark', 'class'=>'redactor', 'value'=>set_value('remark', html_entity_decode($reason)));
						echo form_textarea($data);
						?>		
					</fieldset>							
				</div>
			</div>
		</div>
	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>	
	</div>	
</form>