<?php echo form_open($this->config->item('admin_folder').'/leaves/leave_adjustment_form/'.$id, "id = 'application_form' class='form-horizontal'"); ?>
	
	<div class="row">
	<div class="col-lg-12">
         <div class="ibox float-e-margins">
		  <div class="ibox-title">
                            <h5><?php echo lang('details');?></h5>
                            
							</div>
							
							
		 <div class="ibox-content">
      
		
		 
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('name')?>:</label>

		<?php echo $firstname ?> &nbsp; <?php echo $lastname ?>
		</div>
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('email')?>:</label>
		 <?php echo $email ?>
		
		</div>
		

		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('application_date')?>: </label>
	<?php echo date("d-m-Y") ?>
		</div>
		
		
        
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('application_date')?>:</label>
	 <?php echo date("d-m-Y") ?>
		
		</div>
		
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('annual_leave_balance')?>:</label>
     <?php echo isset($annual_left->total) && !empty($annual_left->total) ? $annual_left->total : 0?>
		</div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('sick_leave_balance')?>:</label>
		  <?php echo isset($sick_left->total) && !empty($sick_left->total) ? $sick_left->total : 0 ?></center>
		</div>
		

		 
		 
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('adjustment_type')?>:</label>	
		<?php
						 	$options = array('in'	=> lang('adjust_in'),
											 'out'	=> lang('adjust_out'));
							echo '<div class="col-sm-10">'.form_dropdown('adjustment_type', $options, set_value('adjustment_type'), 'class="form-control m-b"').'</div>';
							?>	
		</div>
		
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('leave_type')?>:</label>	
		<?php
							 	$options = array('Annual Leave'	=> lang('annual_leave'),
												 'Sick Leave'	=> lang('sick_leave'));
								echo '<div class="col-sm-10">'.form_dropdown('leave_type', $options, set_value('leave_type'), 'class="form-control m-b"').'</div>';
								?>	
		</div>

		
		
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('no_of_day');?>:</label>	
		<?php
							$data	= array('name'=>'qty', 'value'=>set_value('qty', $qty), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>';
							?>
		</div>
		
		
		
		
		<div class="form-group"><label class="col-sm-2 control-label" for="desc"><?php echo lang('desc');?></label>
														
							<textarea class="input-block-level" id="summernote" name="desc" rows="5">
                        	
                        	</textarea>
							
		</div>	
						 
						 
		
		
		
		
		

		
		
		

			
		
		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div>
		
		

	
</form>

</div>
</div>
</div>
</div>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	