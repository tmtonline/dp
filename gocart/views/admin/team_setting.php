<?php echo form_open($this->config->item('admin_folder').'/team/form/'.$id); ?>
	
		<label><?php echo lang('name');?></label>
		<?php
		$data	= array('name'=>'name', 'value'=>set_value('name', $name));
		echo form_input($data);
		?>
				
		<label><?php echo lang('weekend_type');?></label>
		<?php
		$options = array(	'1'		=> 'Odd Saturday',
							'2'		=> 'Even Saturday',
							'3'		=> 'Full Work Weekend',
							'4'		=> 'No Work Weekend'
		                );
		echo form_dropdown('weekendID', $options, set_value('weekendID', $weekendID));
		?>

		
		<label><?php echo lang('desc');?></label>
		<?php
		$data	= array('rows'=>'3', 'name'=>'desc', 'value'=>set_value('meta', html_entity_decode($desc)), 'class'=>'span12');
		echo form_textarea($data);
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