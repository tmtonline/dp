<?php echo form_open($this->config->item('admin_folder').'/weekend_schedule/form/'.$id); ?>
	
		<label><?php echo lang('team');?></label>
		<?php				
			foreach($teams as $team):
				$options[$team->id] = $team->name;
			endforeach;
						
			echo form_dropdown('teamID', $options, set_value('teamID', !empty($weekend_schedules[0]->teamID) ? $weekend_schedules[0]->teamID : '' ));
		?>
		
		<label><?php echo lang('staff');?></label>
		<?php				
			foreach($staffs as $staff):
				$checked = '';				
				if(in_array($staff->id, $staff_list)):
					$checked = 'checked';
				endif;			
		?>				
			<input type="checkbox" name="staffID[]" <?php echo $checked?> value="<?php echo $staff->id ?>">&nbsp;<?php echo $staff->firstname.' '.$staff->lastname ?><br/>
		<?php
			endforeach;									
		?>
		
							
		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div>
	
</form>
<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>