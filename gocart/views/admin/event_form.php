<?php echo form_open_multipart($this->config->item('admin_folder').'/event/form/'.$id); ?>

<div class="tabbable">
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('content');?></a></li>
		
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
					
			<fieldset>						
				<label for="date"><?php echo lang('date');?></label>
				<?php
				$data	= array('name'=>'date', 'value'=>set_value('date', $date), 'class'=>'span12', 'id'=>'select_date');
				echo form_input($data);
				?>
					
				<input id="date_alt" type="hidden" name="start_date" />
				
				<label for="date_to"><?php echo lang('date_to');?></label>
				<?php
				$data	= array('name'=>'date_to', 'value'=>set_value('date_to', $date_to), 'class'=>'span12', 'id'=>'select_date_to');
				echo form_input($data);
				?>
					
				<input id="date_to_alt" type="hidden" name="end_date" />
	
	
				<label for="time"><?php echo lang('time');?></label>
				<?php
				$data	= array('name'=>'time', 'value'=>set_value('time', $time), 'class'=>'span12', 'id'=>'select_time');
				echo form_input($data);
				?>
				
				<input id="time_alt" type="hidden" name="start_time" />
				
				<label for="time_to"><?php echo lang('time_to');?></label>
				<?php
				$data	= array('name'=>'time_to', 'value'=>set_value('time_to', $time_to), 'class'=>'span12', 'id'=>'select_time_to');
				echo form_input($data);
				?>
				
				<input id="time_to_alt" type="hidden" name="end_time" />
				
				
				<label for="event"><?php echo lang('event');?></label>
				<?php
				$data	= array('name'=>'event', 'value'=>set_value('event', $event), 'class'=>'span12');
				echo form_input($data);
				?>
				
				<label for="venue"><?php echo lang('venue');?></label>
				<?php
				$data	= array('name'=>'venue','value'=>set_value('venue', $venue), 'class'=>'span12');
				echo form_textarea($data);
				?>
				
				<label for="brands"><?php echo lang('brands');?></label>
				<?php
				$data	= array('name'=>'brands' ,'value'=>set_value('brands', $brands), 'class'=>'span12');
				echo form_input($data);
				?>																
			
				<label for="status"><?php echo lang('status');?> </label>
				<?php
			 	$options = array(	 'Enable'		=> lang('enable')
									,'Disable'		=> lang('disable')
									);
				echo form_dropdown('status', $options, set_value('status',$status), 'class = "span12"');
				?>
			</fieldset>
		</div>

				
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>



	